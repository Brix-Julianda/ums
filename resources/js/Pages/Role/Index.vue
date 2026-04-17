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

      <Link :href="route('role.create')" as="button"
        class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 bg-green-100 hover:bg-green-200 px-3 py-2 rounded-lg transition">
        <i class="fa fa-plus"></i>

      </Link>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

      <table class="w-full text-sm">

        <!-- HEADER -->
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
          <tr>
            <th class="px-4 py-3 text-left">ID</th>
            <th class="px-4 py-3 text-left">Role</th>
            <th class="px-4 py-3 text-center">Action</th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody>

          <tr v-for="role in role" :key="role.id" class="border-t hover:bg-gray-50 transition">

            <td class="px-4 py-2 text-gray-700">
              {{ role.id }}
            </td>

            <td class="px-4 py-2 font-medium text-gray-800">
              {{ role.name }}
            </td>

            <!-- ACTIONS -->
            <td class="px-4 py-2">
              <div class="flex justify-center gap-2">

                <span class="text-xs text-gray-400">
                  —
                </span>

              </div>
            </td>

          </tr>

          <!-- EMPTY STATE -->
          <tr v-if="!role || role.length === 0">
            <td colspan="3" class="text-center py-6 text-gray-500 italic">
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