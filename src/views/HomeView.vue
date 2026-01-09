<script setup>
import AppNavbar from '@/components/layouts/partials/AppNavbar.vue';

const user = localStorage.getItem('user')
const removeUser = () => {
  localStorage.removeItem('user')
}
removeUser()
console.log(user)
</script>

<template>
  <AppNavbar />
  <main>
    <h2 class='text-2xl h-[100vmin]'>hallo world</h2>
  </main>
</template>
