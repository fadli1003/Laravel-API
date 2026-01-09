<script setup lang="ts">
import CardItem from '@/components/CardItem.vue';
import HeaderItem from '@/components/HeaderItem.vue';
import AdminLayout from '@/components/layouts/AdminLayout.vue';
import SearchItem from '@/components/SearchItem.vue';

defineProps({
  nama: {
      type: String,
  },
  msg: {
      type: String,
  }
})


</script>

<template>
  <admin-layout>
    <HeaderItem class="rounded-b-none shadow-none"/>
    <search-item />
    <card-item class=" rounded-t-none">
      <h3 class="text-xl capitalize">Dashboard</h3>
      <div class="h-full w-full">

      </div>
    </card-item>
  </admin-layout>
</template>
