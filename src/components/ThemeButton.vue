<script setup>
import { ref, watch} from 'vue';

// Pastikan ada nilai default jika localStorage kosong
const savedTheme = localStorage.getItem('theme') || 'light';
const theme = ref(savedTheme);

// Watcher untuk memantau perubahan theme
watch(theme, (val) => {
  const root = document.documentElement;

  if (val === 'dark') {
    root.classList.add('dark');
  } else {
    root.classList.remove('dark');
  }

  localStorage.setItem('theme', val);
}); // immediate agar saat refresh, tema langsung diterapkan

const toggleTheme = () => {
  theme.value = theme.value === 'dark' ? 'light' : 'dark';
};
</script>

<template>
  <button @click="toggleTheme" class="text-2xl pb-0.5 flex gap-1">
    <slot />
    {{ theme === 'dark' ? '🌚' : '🌞' }}
  </button>
</template>
