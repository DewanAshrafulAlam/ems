<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="bg-white shadow-md rounded p-6 w-full max-w-md text-center">
      <h1 class="text-2xl font-bold mb-4">Welcome, {{ user?.name }}</h1>
      <p class="text-gray-700 mb-2">Email: {{ user?.email }}</p>
      <button
        @click="logout"
        class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
      >
        Logout
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const user = ref(null)
const router = useRouter()

onMounted(async () => {
  try {
    const res = await axios.get('/me')
    user.value = res.data
  } catch {
    router.push('/login')
  }
})

const logout = async () => {
  try {
    await axios.post('/logout')
    localStorage.removeItem('token')
    router.push('/login')
  } catch {
    alert('Logout failed. Please try again.')
  }
}
</script>
