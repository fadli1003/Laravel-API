<script setup>
  import { RouterLink} from 'vue-router'
  import { useAuthStore } from '@/stores/auth'
  import ThemeButton from '@/components/ThemeButton.vue';

  const authStore = useAuthStore()

</script>
<template>
  <header class="backdrop-blur-sm bg-transparent shadow-md shadow-gray-500/10 sticky top-0 z-100">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-green-500 rounded-full" />
        <RouterLink to="/" class="text-xl font-bold">Fresh Fruit</RouterLink>
      </div>
      <nav class="flex items-center space-x-6">
        <theme-button />
        <router-link
          to="/"
          class="hover:dark:text-blue-200 text-blue-900 duration-300"
          active-class="dark:text-blue-200 text-blue-900 font-semibold"
        >
          Beranda
        </router-link>

        <router-link
          v-if="authStore.isAuthenticated"
          to="/admin/dashboard"
          class="dark:text-gray-300 hover:dark:text-blue-200 text-blue-900 duration-300"
          active-class="dark:text-blue-100 text-blue-900 font-semibold"
        >
          Admin
        </router-link>

        <button
          @click="authStore.logout"
          class="px-4 py-1.5 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-md transition"
        >
          Logout
        </button>
        <router-link

          to="/login"
          class="px-4 py-1.5 text-sm font-medium text-gray-300 bg-slate-800 dark:bg-slate-100 dark:text-neutral-800 hover:bg-slate-700 rounded-md duration-300 "
        >
          Login
        </router-link>
      </nav>
    </div>
  </header>
</template>
