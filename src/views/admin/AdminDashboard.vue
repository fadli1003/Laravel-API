<script setup lang="ts">
import CardItem from '@/components/CardItem.vue';
import HeaderItem from '@/components/HeaderItem.vue';
import AdminLayout from '@/components/layouts/AdminLayout.vue';
import SearchView from '@/components/SearchView.vue';

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
  <AdminLayout>
    <SearchView />
    <HeaderItem class="rounded-b-none">
      Hallo {{ nama ? `${nama}` : 'Admin' }}
    </HeaderItem>
    <CardItem class=" rounded-t-none">
      <h3 class="text-xl capitalize">Dashboard</h3>
      <div class="h-full w-full">

      </div>
    </CardItem>
  </AdminLayout>
</template>
