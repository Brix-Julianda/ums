<template>
  <div class="min-h-screen bg-gray-50">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

          <!-- LEFT: BRAND -->
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center shadow-sm">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
              </svg>
            </div>

            <span class="text-lg font-semibold text-gray-800 tracking-tight">
              User Management System
            </span>
          </div>

          <!-- RIGHT: ACCOUNT -->
          <div class="relative" ref="dropdownRef">

            <button @click="toggleDropdown"
              class="flex items-center gap-2 px-3 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
              <div class="w-7 h-7 rounded-full bg-gray-300 flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A7.963 7.963 0 0112 15c2.21 0 4.21.896 5.657 2.343M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>

              <span class="hidden sm:block text-sm text-gray-700">{{ page.props.auth.user.name }}</span>

              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- DROPDOWN -->
            <div v-if="dropdownOpen"
              class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden animate-fadeIn">

              <!-- <Link 
                class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                <i class="fa fa-users text-gray-500"></i>
                Users
              </Link> -->

              <Link :href="route('user.edit', page.props.auth.user.id)" @click="closeDropdown"
                class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                <i class="fa fa-gear text-gray-500"></i>
                Settings
              </Link>

              <Link :href="route('logout')" method="post" as="button"
                class="flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition w-full text-left">
                <i class="fa fa-right-from-bracket"></i>
                Logout
              </Link>

            </div>
          </div>

        </div>
      </div>
    </nav>

    <!-- PAGE -->
    <main class="p-4 sm:p-6">
      <slot />
    </main>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue"
import { Link, usePage } from "@inertiajs/vue3"

const page = usePage();


const dropdownOpen = ref(false)
const dropdownRef = ref(null)

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value
}

const handleClickOutside = (event) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    dropdownOpen.value = false
  }
}

const closeDropdown = () => {
  dropdownOpen.value = false
}

onMounted(() => {
  document.addEventListener("click", handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener("click", handleClickOutside)
})
</script>