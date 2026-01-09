<script setup>
import AppNavbar from '@/components/layouts/partials/AppNavbar.vue';
import { useAuthStore } from '@/stores/auth';
import { onMounted } from 'vue';
// import { onMounted } from 'vue';

const { checkAuth, user } = useAuthStore()

onMounted(()=>checkAuth)
</script>

<template>
  <AppNavbar />
  <div>
    hallo world
    {{ user }}
  </div>
</template>
