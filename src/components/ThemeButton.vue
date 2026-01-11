<script setup>
  import { ref } from 'vue';

  const root = window.document.documentElement;
  const initialTheme = () => {
		const savedTheme = localStorage.getItem('theme');
		if (savedTheme) {
			return savedTheme;
		}
		return 'light';
	};

  const theme = ref(initialTheme())

  const toggleTheme = () => {
    if (theme.value === 'dark'){
      theme.value = 'light'
    }else{
      theme.value = 'dark'
    }
    root.classList.toggle('dark')
    localStorage.setItem('theme', theme.value)
  }
</script>

<template>
  <button @click="toggleTheme" class="text-2xl pb-0.5 flex gap-1">
    <slot />
    {{theme === 'dark' ? '🌚' : '🌞'}}
  </button>
</template>
