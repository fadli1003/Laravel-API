<script setup lang="ts">
import AdminSidebar from '@/components/layouts/partials/AdminSidebar.vue';
// import SearchView from '../SearchView.vue';
import { ref } from 'vue';

const cari = ref(false)
const setCari = () => {
  cari.value = !cari.value
}
</script>

<template>
  <div class="h-screen flex">
    <AdminSidebar :search="setCari" />
    <div class="flex-grow flex flex-col w-full h-full max-md:pl-14 p-1 overflow-x-hidden">
      <slot />
    </div>
  </div>
</template>
