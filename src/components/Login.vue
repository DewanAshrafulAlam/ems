<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h1 class="text-xl text-red-600 text-center">THIS IS THE REAL LOGIN FILE</h1>

      <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
       <form @submit.prevent="handleLogin" class="space-y-4">
        <div>
          <label class="block mb-1">Email</label>
          <input
            v-model="email"
            type="email"
            class="w-full px-4 py-2 border rounded"
            required
          />
        </div>

        <div>
          <label class="block mb-1">Password</label>
          <input
            v-model="password"
            type="password"
            class="w-full px-4 py-2 border rounded"
            required
          />
        </div>

        <div class="text-right">
          <router-link to="/forgot-password" class="text-blue-500 hover:underline text-sm">
            Forgot password?
          </router-link>
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
        >
          Login
        </button>

        <div class="text-center mt-4 text-sm">
          Don't have an account?
          <router-link to="/register" class="text-blue-500 hover:underline">
            Register now
          </router-link>
        </div>

        <div v-if="error" class="text-red-600 mt-2 text-sm text-center">
          {{ error }}
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import api from '@/api'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

console.log('✅ Login component loaded') // Debug log

const handleLogin = async () => {
  console.log('✅ Login clicked') // Debug log

  error.value = ''
  try {
    await axios.get('http://localhost:8000/sanctum/csrf-cookie', {
      withCredentials: true,
    })

    const response = await api.post('/login', {
      email: email.value,
      password: password.value,
    })

    localStorage.setItem('token', response.data.token)
    localStorage.setItem('userRole', response.data.user.role.toLowerCase())
    router.push('/dashboard')
  } catch (err) {
    error.value = err.response?.data?.message || 'Login failed'
    console.error('Login error:', err)
  }
}
</script>
