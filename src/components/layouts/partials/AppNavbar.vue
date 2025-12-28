<script setup>
  import { RouterLink, useRouter } from 'vue-router'
  import { useAuthStore } from '@/stores/auth'

  const authStore = useAuthStore()
  const router = useRouter()

  const handleLogout = async () => {
    await authStore.logout()
    router.push('/login')
  }
</script>
<template>
  <header class="bg-white shadow-md shadow-gray-500/10 ">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-green-500 rounded-full"></div>
        <RouterLink to="/" class="text-xl font-bold dark:text-gray-300 text-gray-800">Fresh Fruit</RouterLink>
      </div>
      <nav class="flex items-center space-x-6">
        <router-link
          to="/"
          class="text-gray-600 dark:text-gray-300 hover:text-green-600 duration-300"
          active-class="text-green-600 font-medium"
        >
          Beranda
        </router-link>

        <!-- Link admin hanya jika login -->
        <router-link
          v-if="authStore.isAuthenticated"
          to="/admin"
          class="text-gray-600 dark:text-gray-300 hover:text-green-600 transition"
          active-class="text-green-600 font-medium"
        >
          Admin
        </router-link>

        <!-- Login / Logout -->
        <button
          v-if="authStore.isAuthenticated"
          @click="handleLogout"
          class="px-4 py-1.5 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-md transition"
        >
          Logout
        </button>
        <router-link
          v-else
          to="/login"
          class="px-4 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-300 dark:bg-slate-800 hover:bg-slate-700 rounded-md duration-300 "
        >
          Login
        </router-link>
      </nav>
    </div>
  </header>
</template>
