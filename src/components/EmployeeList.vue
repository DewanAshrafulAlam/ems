<template>
  <div class="max-w-6xl mx-auto mt-0 p-4">
<!-- OR -->
<!-- <div class="max-w-6xl mx-auto p-4"> -->


    <h2 class="text-2xl font-bold mb-4">Employee List</h2>

    <!-- Search Bar -->
    <div class="mb-4 flex gap-4 flex-wrap">
      <input
        v-model="search"
        type="text"
        placeholder="Search by name, designation, email, or mobile"
        class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded shadow"
      />
    </div>

    <!-- Employee Table -->
    <table class="min-w-full bg-white border border-gray-300 rounded shadow">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 border">ID</th>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Designation</th>
          <th class="px-4 py-2 border">Organization</th>
          <th class="px-4 py-2 border">Email</th>
          <th class="px-4 py-2 border">Mobile</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
           v-for="employee in paginatedEmployees" 
          :key="employee.id"
          class="hover:bg-gray-50">
          <td class="px-4 py-2 border text-center">{{ employee.id }}</td>
          <td class="px-4 py-2 border">{{ employee.name }}</td>
          <td class="px-4 py-2 border">{{ employee.designation }}</td>
          <td class="px-4 py-2 border">{{ employee.organization }}</td>
          <td class="px-4 py-2 border">{{ employee.email }}</td>
          <td class="px-4 py-2 border">{{ employee.mobile }}</td>
          <td class="px-4 py-2 border text-center space-x-2">
            <button
              class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"
              @click="editEmployee(employee)"
            >
              Edit
            </button>
            <button
              class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
              @click="deleteEmployee(employee.id)"
            >
              Delete
            </button>
            
          </td>
        </tr>
      </tbody>
    </table>

    <p v-if="filteredEmployees.length === 0" class="mt-4 text-gray-500">No employees found.</p>
  </div>
  <!-- Pagination Controls -->
<div class="mt-4 flex justify-center items-center space-x-2">
  <button
    :disabled="currentPage === 1"
    @click="currentPage--"
    class="px-3 py-1 border rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
  >
    Prev
  </button>

  <button
    v-for="page in totalPages"
    :key="page"
    @click="currentPage = page"
    :class="[
      'px-3 py-1 border rounded',
      currentPage === page ? 'bg-blue-500 text-white' : 'bg-gray-100 hover:bg-gray-200'
    ]"
  >
    {{ page }}
  </button>

  <button
    :disabled="currentPage === totalPages"
    @click="currentPage++"
    class="px-3 py-1 border rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
  >
    Next
  </button>
</div>

</template>

<script>
import apiClient from '../api';

export default {
  data() {
  return {
    employees: [],
    search: '',
    currentPage: 1,
    perPage: 5,
  };
},
  computed: {
  filteredEmployees() {
    const term = this.search.toLowerCase();
    return this.employees.filter(emp =>
      emp.name.toLowerCase().includes(term) ||
      emp.designation.toLowerCase().includes(term) ||
      emp.email.toLowerCase().includes(term) ||
      emp.mobile.toLowerCase().includes(term)
    );
  },
  paginatedEmployees() {
    const start = (this.currentPage - 1) * this.perPage;
    const end = start + this.perPage;
    return this.filteredEmployees.slice(start, end);
  },
  totalPages() {
    return Math.ceil(this.filteredEmployees.length / this.perPage);
  },
},

  methods: {
    editEmployee(employee) {
      // Redirect or open modal for editing
      console.log('Edit:', employee);
      this.$router.push(`/dashboard/employees/${employee.id}/edit`);
    },
    async deleteEmployee(id) {
      if (confirm('Are you sure you want to delete this employee?')) {
        try {
          await apiClient.delete(`/employees/${id}`);
          this.employees = this.employees.filter(emp => emp.id !== id);
        } catch (error) {
          console.error('Delete error:', error);
        }
      }
    },
    
  },
  async mounted() {
    try {
      const response = await apiClient.get('/employees');
      this.employees = response.data;
    } catch (error) {
      console.error('Fetch error:', error);
    }
  },
};
</script>
