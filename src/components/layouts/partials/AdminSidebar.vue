<script setup lang="ts">
import IconCommunity from '@/components/icons/IconCommunity.vue';
import IconEcosystem from '@/components/icons/IconEcosystem.vue';
import { ref } from 'vue';
import { RouterLink } from 'vue-router';

const activeSidebar = ref(false)

const toggleSidebar = () => {
  activeSidebar.value = !activeSidebar.value
}

// defineProps({search})

</script>

<template>
  <aside :class="`${activeSidebar ? 'w-64 px-4' : 'max-md:w-[54px] max-md:px-2'}`">
    <div
      class="md:text-xl font-bold tracking-wider uppercase flex justify-center"><RouterLink to="/admin">logo</RouterLink></div>
    <div class="relative">
      <span class="absolute top-0 right-0 bg-white/20 rounded-full px-2.5 py-0.5 font-bold font-mono translate-x-6 -translate-y-3 cursor-pointer md:hidden duration-300" @click="toggleSidebar">{{ activeSidebar === true ? '<' : '>' }}</span>
      <div class="h-[.09rem] w-full mt-[19px] justify-self-center bg-slate-800" />
    </div>
    <nav class="flex flex-col gap-2 mt-4">
      <RouterLink to="/admin"
        :class="`flex gap-3  border dark:border-gray-700 border-gray-300 py-2 rounded-md ${activeSidebar ? 'px-3':'px-2 max-md:justify-center'}`"

      >
        <IconCommunity />
        <span :class="`${activeSidebar ? 'block ':'max-md:hidden'}`">Dashboard</span>
      </RouterLink>
      <RouterLink to="/admin/laporan"
        :class="`flex gap-3 border  dark:border-gray-700 border-gray-300 py-2 rounded-md ${activeSidebar ? 'px-3':'px-2 max-md:justify-center'}`">
        <IconEcosystem />
        <span :class="`${activeSidebar ? 'block ':'max-md:hidden'}`">Laporan</span>
      </RouterLink>
    </nav>
  </aside>
</template>
