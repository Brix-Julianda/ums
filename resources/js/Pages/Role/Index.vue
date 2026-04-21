<template>
  <div class="p-4 sm:p-6 space-y-4">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

      <!-- Back Button -->
      <Link :href="route('user.index')" as="button"
        class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg transition">
        <i class="fa fa-arrow-left"></i>
        Back
      </Link>

      <!-- Add Button -->
      <Link :href="route('role.create')" as="button"
        class="flex items-center gap-2 text-sm text-white bg-green-500 hover:bg-green-600 px-3 py-2 rounded-lg transition">
        <i class="fa fa-plus"></i>
        Add Role
      </Link>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

      <table class="w-full text-sm text-center">

        <!-- HEADER -->
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Role</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody>

          <tr v-for="role in role" :key="role.id" class="border-t hover:bg-gray-50 transition">

            <!-- ID -->
            <td class="px-4 py-3 text-gray-700">
              {{ role.id }}
            </td>

            <!-- ROLE -->
            <td class="px-4 py-3 font-semibold text-gray-800">
              {{ role.role_name }}
            </td>

            <!-- ACTIONS -->
            <td class="px-4 py-3">
              <div class="flex justify-center gap-3">

                <!-- EDIT -->
                <Link as="button" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition"
                  title="Edit">
                  <i class="fa fa-pencil"></i>
                </Link>

                <!-- DELETE -->
                <button class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition" title="Delete">
                  <i class="fa fa-trash"></i>
                </button>

              </div>
            </td>

          </tr>

          <!-- EMPTY STATE -->
          <tr v-if="!role || role.length === 0">
            <td colspan="3" class="py-6 text-gray-500 italic">
              No roles found
            </td>
          </tr>

        </tbody>

      </table>

    </div>

  </div>
</template>
<script setup>
import AppLayout from '../Shared/NavBar.vue'
import { Link } from '@inertiajs/vue3'


defineOptions({
  layout: AppLayout,
})

const props = defineProps({
  role: Object
})
</script>
<style scoped></style>