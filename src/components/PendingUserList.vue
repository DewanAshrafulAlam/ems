<template>
  <div>
    <h3 class="text-xl font-bold mb-4">Pending Users</h3>

    <div v-if="pendingUsers.length === 0">No pending users found.</div>

    <ul v-else>
      <li
        v-for="user in pendingUsers"
        :key="user.id"
        class="mb-2 p-4 border rounded flex justify-between items-center"
      >
        <div>
          <p><strong>{{ user.name }}</strong> - {{ user.email }}</p>
        </div>
        <div class="flex items-center space-x-2">
          <select v-model="selectedRoles[user.id]" class="px-2 py-1 border rounded">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>

          <button
            @click="approveUser(user.id)"
            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
          >
            Approve
          </button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../api'
import { useToast } from 'vue-toastification'

const pendingUsers = ref([])
const selectedRoles = ref({})
const toast = useToast()



const fetchUsers = async () => {
  try {
    const response = await api.get('/users/pending')
    pendingUsers.value = response.data

    response.data.forEach(user => {
      selectedRoles.value[user.id] = user.role || 'user'
    })
  } catch (err) {
    console.error('Error fetching users:', err)
    toast.error('⚠️ Failed to load pending users.')
  }
}

const approveUser = async (id) => {
  try {
    const role = selectedRoles.value[id] || 'user'
    await api.post(`/users/approve/${id}`, { role })
    toast.success(`✅ Approved ${role} user successfully!`)
    await fetchUsers()
  } catch (err) {
    console.error('Approve error:', err)
    toast.error('❌ Failed to approve user.')
  }
}

onMounted(fetchUsers)
</script>
