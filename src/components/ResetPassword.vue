<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded shadow-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Reset Password</h2>
      <form @submit.prevent="submit" class="space-y-4">
        <input
          v-model="email"
          type="email"
          placeholder="Enter your email"
          class="w-full px-4 py-2 border rounded"
        />
        <input
          v-model="password"
          type="password"
          placeholder="New password"
          class="w-full px-4 py-2 border rounded"
        />
        <input
          v-model="password_confirmation"
          type="password"
          placeholder="Confirm password"
          class="w-full px-4 py-2 border rounded"
        />
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">
          Reset Password
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '../api'
import axios from 'axios' // For CSRF cookie

const route = useRoute()
const router = useRouter()

const token = route.params.token
const email = ref('')
const password = ref('')
const password_confirmation = ref('')

const submit = async () => {
  try {
    // 1. CSRF cookie (important for Laravel session and Sanctum)
    await axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie', {
      withCredentials: true,
    })

    // 2. Call reset-password route
    await api.post('/reset-password', {
      token,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    })

    alert('Password reset successful')
    router.push('/login')
  } catch (error) {
    console.error(error)
    alert('Reset failed. Please check your inputs or try again.')
  }
}

</script>


