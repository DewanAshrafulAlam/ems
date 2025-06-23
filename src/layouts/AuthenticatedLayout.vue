<template>
  <div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Main Navbar -->
    <nav class="h-20 p-6 flex justify-between items-center bg-red-600 text-white">
      <div class="font-bold text-lg">Dashboard</div>
      <div class="space-x-4">
        <router-link to="/dashboard/profile" class="hover:underline">Profile</router-link>
        <button @click="logout" class="hover:underline">Logout</button>
      </div>
    </nav>

    <!-- Body: Sidebar + Main Content -->
    <div class="flex flex-1">
      <!-- Sidebar -->
      <aside class="w-64 p-4 bg-green-600 text-white space-y-4">
        <router-link to="/dashboard/employees/create" class="block hover:underline">Employee Form</router-link>
        <router-link to="/dashboard/employees" class="block hover:underline">Employee List</router-link>
      </aside>

      <!-- Main Area -->
      <main class="flex-1 p-6 bg-white">
        <router-view />
      </main>
    </div>
  </div>
</template>
<script setup>
import { useRouter } from 'vue-router'
import api from '../api'

const router = useRouter()

const logout = async () => {
  await api.post('/logout')
  localStorage.removeItem('token')
  router.push('/login')
}
</script>
