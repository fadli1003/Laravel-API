<script setup>
  import { RouterLink } from 'vue-router';
</script>
<template>
  <Header>
    <nav>
      <RouterLink to="/">DashBoard</RouterLink>
      <RouterLink to="/register">Register</RouterLink>
      <RouterLink to="/admin">Admin</RouterLink>
    </nav>
  </Header>
</template>
