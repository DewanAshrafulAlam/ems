<template>
  <div class="max-w-4xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Employee List</h2>

    <table class="min-w-full bg-white border border-gray-300 rounded shadow">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 border">ID</th>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Designation</th>
          <th class="px-4 py-2 border">Organization</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in employees" :key="employee.id" class="hover:bg-gray-50">
          <td class="px-4 py-2 border text-center">{{ employee.id }}</td>
          <td class="px-4 py-2 border">{{ employee.name }}</td>
          <td class="px-4 py-2 border">{{ employee.designation }}</td>
          <td class="px-4 py-2 border">{{ employee.organization }}</td>
        </tr>
      </tbody>
    </table>

    <p v-if="employees.length === 0" class="mt-4 text-gray-500">No employees found.</p>
  </div>
</template>
<script>
import apiClient from '../api';

export default {
  data() {
    return {
      employees: [],
    };
  },
  async mounted() {
    const response = await apiClient.get('/employees');
    this.employees = response.data;
  },
};
</script>
