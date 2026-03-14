<template>
  <div class="p-6">

    <!-- Page Title + Buttons -->
    <div class="flex mb-4 w-full justify-end space-x-2 gap-2">
      <Link :href="route('user.create')" as="button"
        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
        Create User
      </Link>
      <Link href="/roles/create" as="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
        Create Role
      </Link>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-3 text-left">Id</th>
            <th class="px-4 py-3 text-left">Name</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Roles</th>
            <th class="px-4 py-3 text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users.data" :key="user.id" class="border-t hover:bg-gray-50">
            <td class="px-4 py-3">{{ user.id }}</td>
            <td class="px-4 py-3">{{ user.name }}</td>
            <td class="px-4 py-3">{{ user.email }}</td>

            <!-- Roles with fallback -->
            <td class="px-4 py-3">
              <template v-if="user.roles.length > 0">
                <span v-for="role in user.roles" :key="role.id"
                  class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm mr-1">
                  {{ role.name }}
                </span>
              </template>
              <template v-else>
                <span class="text-gray-500 italic text-sm">No roles assigned</span>
              </template>
            </td>

            <!-- Actions -->
            <td class="flex justify-center px-4 py-3 space-x-2 gap-2">
              <Link :href="route('user.edit', user.id)" as="button"
                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                View
              </Link>

              <button @click.prevent="confirmDelete(user.id)"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end mt-6 space-x-2">
      <Link v-for="link in users.links" :key="link.label" :href="link.url || ''" v-html="link.label" as="button"
        class="px-3 py-1 border rounded no-underline" :class="{
          'bg-blue-500 text-white': link.active,
          'text-gray-500 pointer-events-none': !link.url
        }" />
    </div>
  </div>
</template>

<script setup>
import { route } from 'ziggy-js';
import AppLayout from '../Shared/NavBar.vue'
import { Link } from '@inertiajs/vue3'
import Swal from 'sweetalert2';
import axios from 'axios';

defineOptions({
  layout: AppLayout,
});

const props = defineProps({
  users: Object,
});

// Delete confirmation
const confirmDelete = (userId) => {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Delete User'
  }).then((result) => {
    if (result.isConfirmed) {
      axios.delete(route('user.destroy', userId))
        .then((res) => {
          Swal.fire({
            title: 'User Deleted!',
            text: res.data.message,
            icon: 'success',
            confirmButtonText: 'OK',
          }).then(() => {
            window.location.href = res.data.redirect;
          });
        })
        .catch((error) => {
          if (error.response && error.response.data.errors) {
            const messages = Object.value(error.response.data.errors).flat();
            Swal.fire({
              title: 'Error',
              html: messages.join('<br>'),
              icon: 'error',
            });
          }
        })
    }
  });
};
</script>