<script setup lang="ts">
import IconDocumentation from './icons/IconDocumentation.vue';
import IconEcosystem from './icons/IconEcosystem.vue';
import { ref } from 'vue';

const isSearch = ref(false)

function openSearch(){
  isSearch.value = !isSearch.value
}
// function handleSearch($props){

// }

</script>

<template>
  <div class="fixed top-5 right-4">
    <div class="dark:bg-white/10 rounded-3xl flex py-0.5 px-1 items-center relative">
      <label for="search" class="flex items-center cursor-pointer md:hidden px-1.5 py-1.5" @click="openSearch">
        <IconEcosystem v-if="isSearch === false" />
        <IconDocumentation v-else />
      </label>
      <input
        id="search"
        name="search"
        type="text"
        placeholder="Search..."
        :class="`py-1 md:pl-3 md:pr-8 rounded-3xl max-md:max-w-[120px] backdrop-blur bg-transparent focus:ring-0 focus:outline-0 dark:text-gray-200 transition-transform duration-500 ${isSearch ? 'max-md:block max-md:opacity-100 translate-x-0 pl-1 pr-8': ' max-md:translate-x-[100%] max-md:size-0 max-md:opacity-0'}`"
      >
      <IconEcosystem :class="`absolute right-2.5 cursor-pointer ${isSearch ? 'block' : 'max-md:hidden'}`" />
      <!-- <IconSupport v-if="isSearch" @click.prevent="() => handleSearch($props)" /> -->
    </div>
  </div>
</template>
