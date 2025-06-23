<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded shadow-md">
      <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
      <form @submit.prevent="login" class="space-y-4">
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

        <!-- Login Button -->
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
        >
          Login
        </button>

        <!-- Forgot Password -->
        <div class="text-center">
          <router-link
            to="/forgot-password"
            class="text-sm text-blue-500 hover:underline"
          >
            Forgot password? Click here
          </router-link>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-2">
          <span class="text-sm text-gray-600">Don't have an account? </span>
          <router-link
            to="/register"
            class="text-sm text-blue-500 hover:underline"
          >
            Register here
          </router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api'

const router = useRouter()

const form = ref({
  email: '',
  password: ''
})

const login = async () => {
  try {
    const res = await api.post('/login', form.value)

    // Store token in localStorage
    localStorage.setItem('token', res.data.token)

    // Set token for future requests
    api.defaults.headers.common['Authorization'] = `Bearer ${res.data.token}`

    // ✅ Redirect to dashboard after successful login
    router.push('/dashboard/employees')
  } catch (err) {
    alert('Login failed')
  }
}
</script>
