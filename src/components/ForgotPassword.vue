<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded shadow-md">
      <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>
      <form @submit.prevent="submit" class="space-y-4">
        <!-- Email Input -->
        <input
          v-model="email"
          type="email"
          placeholder="Enter your email address"
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
        />

        <!-- Submit Button -->
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
        >
          Send Reset Link
        </button>

        <!-- Back to Login Link -->
        <div class="text-center mt-4">
          <router-link to="/login" class="text-sm text-blue-500 hover:underline">
            Back to Login
          </router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '../api'

const email = ref('')

const submit = async () => {
  try {
    await api.post('/forgot-password', { email: email.value })
    alert('Reset link sent to your email.')
  } catch (err) {
    alert('Failed to send reset link. Make sure your email is correct.')
  }
}
</script>
