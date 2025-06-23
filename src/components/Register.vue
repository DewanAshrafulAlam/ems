<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded shadow-md">
      <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
      <form @submit.prevent="register" class="space-y-4">
        <!-- Name -->
        <input
          v-model="form.name"
          type="text"
          placeholder="Full Name"
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
        />

        <!-- Email -->
        <input
          v-model="form.email"
          type="email"
          placeholder="Email"
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
        />

        <!-- Password -->
        <input
          v-model="form.password"
          type="password"
          placeholder="Password"
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
        />

        <!-- Confirm Password -->
        <input
          v-model="form.password_confirmation"
          type="password"
          placeholder="Confirm Password"
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
        />

        <!-- Register Button -->
        <button
          type="submit"
          class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700"
        >
          Register
        </button>

        <!-- Link to Login -->
        <div class="text-center mt-2">
          <span class="text-sm text-gray-600">Already have an account? </span>
          <router-link
            to="/login"
            class="text-sm text-blue-500 hover:underline"
          >
            Login here
          </router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import api from '../api' // your configured axios instance

const router = useRouter()
const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const register = async () => {
  try {
    // Step 1: Get CSRF cookie
    await axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie', {
      withCredentials: true
    })

    // Step 2: Register using your configured API instance
    const res = await api.post('/register', form.value)

    // Step 3: Save token and redirect
    localStorage.setItem('token', res.data.token)
    router.push('/dashboard/employees')
  } catch (err) {
    console.error('Registration error:', err.response?.data)

    if (err.response?.status === 422 && err.response.data?.errors) {
      const errorMessages = Object.values(err.response.data.errors).flat()
      alert(errorMessages.join('\n'))
    } else if (err.response?.data?.message) {
      alert(err.response.data.message)
    } else {
      alert('Registration failed. Please check your input.')
    }
  }
}
</script>
