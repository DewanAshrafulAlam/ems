<template>
  <div class="space-y-6">
    <h3 class="text-2xl font-bold">Approved Users</h3>

    <!-- Search and Filter -->
    <div class="flex flex-wrap gap-4">
      <input
        v-model="search"
        type="text"
        placeholder="Search by name or email..."
        class="border rounded px-3 py-2 w-full sm:w-1/2"
      />
      <select v-model="filterRole" class="border rounded px-3 py-2 w-full sm:w-1/4">
        <option value="">All Roles</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
    </div>

    <!-- Approved Users List -->
    <div v-if="filteredUsers.length === 0" class="text-gray-500">No approved users found.</div>

    <ul v-else class="space-y-2">
      <li
        v-for="user in filteredUsers"
        :key="user.id"
        class="p-4 border rounded shadow flex justify-between items-center"
      >
        <div>
          <p><strong>{{ user.name }}</strong></p>
          <p>{{ user.email }}</p>
        </div>
        <span class="text-sm px-2 py-1 bg-blue-100 text-blue-800 rounded capitalize">
          {{ user.role }}
        </span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'  // ✅ Import useRoute here
import api from '../api'
import { useToast } from 'vue-toastification'

const route = useRoute()               // ✅ Call useRoute inside <script setup>
const approvedUsers = ref([])
const search = ref('')
const filterRole = ref('')
const toast = useToast()

const fetchApprovedUsers = async () => {
  try {
    const res = await api.get('/users/approved')
    approvedUsers.value = res.data
  } catch (err) {
    toast.error('❌ Failed to load approved users.')
  }
}

// ✅ Fetch on mount
onMounted(fetchApprovedUsers)

// ✅ Re-fetch if the route changes (e.g., user clicks the same menu again)
watch(() => route.fullPath, fetchApprovedUsers)

const filteredUsers = computed(() => {
  return approvedUsers.value.filter(user => {
    const matchesSearch =
      user.name.toLowerCase().includes(search.value.toLowerCase()) ||
      user.email.toLowerCase().includes(search.value.toLowerCase())
    const matchesRole = filterRole.value === '' || user.role === filterRole.value
    return matchesSearch && matchesRole
  })
})
</script>
