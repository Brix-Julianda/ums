<template>
  <div class="min-h-screen bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">

          <!-- Left : App Name -->
          <div class="flex items-center gap-2">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>

            <span class="text-lg font-semibold text-gray-700">
              MyApp
            </span>
          </div>

          <!-- Right : Dropdown -->
          <div class="relative" ref="dropdownRef">

            <button @click="toggleDropdown"
              class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg">
              <!-- user icon -->
              <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M5.121 17.804A7.963 7.963 0 0112 15c2.21 0 4.21.896 5.657 2.343M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>

              <span class="hidden sm:block">Account</span>

              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Dropdown -->
            <div v-if="dropdownOpen" class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-lg">

              <!-- Users -->
              <Link href="/users" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A7.963 7.963 0 0112 15c2.21 0 4.21.896 5.657 2.343M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Users
              </Link>

              <!-- Settings -->
              <Link href="/settings" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    d="M11.983 5.5a1.5 1.5 0 013.034 0l.357 1.65a1.5 1.5 0 001.12 1.12l1.65.357a1.5 1.5 0 010 3.034l-1.65.357a1.5 1.5 0 00-1.12 1.12l-.357 1.65a1.5 1.5 0 01-3.034 0l-.357-1.65a1.5 1.5 0 00-1.12-1.12l-1.65-.357a1.5 1.5 0 010-3.034l1.65-.357a1.5 1.5 0 001.12-1.12l.357-1.65z" />
                </svg>
                Settings
              </Link>

              <!-- Logout -->
              <Link :href="route('logout')" method="post" as="button"
                class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 text-red-500 w-full text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                Logout
              </Link>

            </div>
          </div>

        </div>
      </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main class="p-6">
      <slot />
    </main>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue"
import { Link } from "@inertiajs/vue3"

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

onMounted(() => {
  document.addEventListener("click", handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener("click", handleClickOutside)
})
</script>