<template>
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Employee Form</h2>
    <form @submit.prevent="submitForm" class="space-y-4">
      <input v-model="form.id" type="text" placeholder="ID" class="block w-full border rounded px-3 py-2" />
      <input v-model="form.name" type="text" placeholder="Name" class="block w-full border rounded px-3 py-2" />
      <input v-model="form.designation" type="text" placeholder="Designation" class="block w-full border rounded px-3 py-2" />
      <input v-model="form.organization" type="text" placeholder="Organization" class="block w-full border rounded px-3 py-2" />
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>

    <div v-if="submitted" class="mt-6">
      <h3 class="font-bold mb-2">Submitted Data</h3>
      <ul class="list-disc pl-5">
        <li><strong>ID:</strong> {{ form.id }}</li>
        <li><strong>Name:</strong> {{ form.name }}</li>
        <li><strong>Designation:</strong> {{ form.designation }}</li>
        <li><strong>Organization:</strong> {{ form.organization }}</li>
      </ul>
    </div>
  </div>
</template>


<script>
import apiClient from '../api'; // adjust the path if needed

export default {
  data() {
    return {
      form: {
        name: '',
        designation: '',
        organization: '',
      },
      submitted: false,
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await apiClient.post('/employees', this.form);
        console.log('Saved:', response.data);
        this.submitted = true;
      } catch (error) {
        console.error('Error saving employee:', error.response?.data || error.message);
      }
    },
  },
};
</script>
