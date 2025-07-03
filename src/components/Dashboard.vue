<!-- src/components/Dashboard.vue -->
<template>
  <div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Navbar -->
    <nav class="h-20 p-6 flex justify-between items-center bg-red-600 text-white">
      <div class="font-bold text-lg">Dashboard</div>
      <div class="space-x-4">
        <router-link to="/dashboard/profile" class="hover:underline">Profile</router-link>
        <button @click="logout" class="hover:underline">Logout</button>
      </div>
    </nav>

    <!-- Sidebar + Main -->
    <div class="flex flex-1">
      <!-- Sidebar -->
      <aside class="w-64 p-4 bg-green-600 text-white space-y-4">
        <router-link
          v-if="role === 'user' || role === 'admin'"
          to="/dashboard/employees/create"
          class="block hover:underline"
        >Employee Form</router-link>
        <router-link to="/dashboard/employees" class="block hover:underline">Employee List</router-link>

        <div v-if="role === 'admin'">
          <div class="font-semibold text-white">User Management</div>
          <router-link to="/dashboard/user-management/pending" class="block ml-4 text-blue-200 hover:underline">
            Pending Users
          </router-link>
          <router-link to="/dashboard/user-management/approved" class="block ml-4 text-green-200 hover:underline">
            Approved Users
          </router-link>
        </div>
      </aside>

      <!-- Main Content -->
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
const role = localStorage.getItem('userRole')

const logout = async () => {
  await api.post('/logout')
  localStorage.removeItem('token')
  router.push('/login')
}
</script>
