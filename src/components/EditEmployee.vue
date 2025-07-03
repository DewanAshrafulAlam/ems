<!-- src/views/EditEmployee.vue -->
<template>
  <div class="max-w-xl mx-auto mt-8 p-4 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Edit Employee</h2>

    <form @submit.prevent="updateEmployee" class="space-y-4">
      <div>
        <label class="block mb-1">Name</label>
        <input v-model="form.name" class="w-full border p-2 rounded" required />
      </div>

      <div>
        <label class="block mb-1">Designation</label>
        <input v-model="form.designation" class="w-full border p-2 rounded" required />
      </div>

      <div>
        <label class="block mb-1">Organization</label>
        <input v-model="form.organization" class="w-full border p-2 rounded" required />
      </div>

      <div>
        <label class="block mb-1">Email</label>
        <input type="email" v-model="form.email" class="w-full border p-2 rounded" required />
      </div>

      <div>
        <label class="block mb-1">Mobile</label>
        <input v-model="form.mobile" class="w-full border p-2 rounded" required />
      </div>

      <div class="flex justify-between">
        <router-link to="/dashboard/employees" class="text-gray-600">Cancel</router-link>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Update
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import api from '../api'
import { useRoute, useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'

export default {
  setup() {
    const route = useRoute()
    const router = useRouter()
    const form = ref({
      name: '',
      designation: '',
      organization: '',
      email: '',
      mobile: ''
    })

    const fetchEmployee = async () => {
      try {
        const res = await api.get(`/employees/${route.params.id}`)
        form.value = res.data
      } catch (err) {
        console.error('Fetch error:', err)
      }
    }

    const updateEmployee = async () => {
      try {
        await api.put(`/employees/${route.params.id}`, form.value)
        router.push('/dashboard/employees')
      } catch (err) {
        console.error('Update error:', err)
      }
    }

    onMounted(fetchEmployee)

    return { form, updateEmployee }
  }
}
</script>
