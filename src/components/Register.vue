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

  <!-- ✅ Role Selection -->
  <select
    v-model="form.role"
    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
  >
    <option value="user">User</option>
    <option value="admin">Admin</option>
  </select>

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

import { useToast } from 'vue-toastification'

const toast = useToast()

const router = useRouter()
const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'user' // default selection
})

const register = async () => {
  try {
    const res = await api.post('/register', form.value)

    toast.success('Registration successful! Please wait for admin approval.')
    router.push('/login')
  } catch (err) {
    toast.error(err.response?.data?.message || 'Registration failed.')
  }
}



</script>
