<script setup lang="ts">
import IconCommunity from '@/components/icons/IconCommunity.vue';
import IconEcosystem from '@/components/icons/IconEcosystem.vue';
import ThemeButton from '@/components/ThemeButton.vue';
import { ref } from 'vue';
import { RouterLink } from 'vue-router';

const activeSidebar = ref(false);

const toggleSidebar = () => {
	activeSidebar.value = !activeSidebar.value;
};

// defineProps({search})
// await api.get('/user')
</script>

<template>
	<aside :class="`${activeSidebar ? 'w-64 px-4' : 'max-md:w-[54px] max-md:px-2'}`">
		<div class="md:text-xl font-bold tracking-wider uppercase flex justify-center">
			<RouterLink to="/admin/dashboard">logo</RouterLink>
		</div>
		<div class="relative">
			<span
				:class="`absolute top-0 right-0 dark:bg-white/20 bg-black/20 rounded-full px-2.5 py-0.5 font-bold font-mono ${activeSidebar ? 'translate-x-7' : 'translate-x-6'} -translate-y-3.5 cursor-pointer md:hidden duration-300`"
				@click="toggleSidebar"
				>{{ activeSidebar === true ? '<' : '>' }}</span
			>
			<div class="h-[.09rem] md:w-full w-[95%] mt-3.5 justify-self-center bg-slate-800" />
		</div>
		<div class="flex flex-col justify-between h-[calc(100%-30px)]">
			<nav class="flex flex-col gap-2 mt-4">
				<RouterLink
					to="/admin/dashboard"
					:class="`flex gap-3  border dark:border-gray-700 border-gray-300 py-2 rounded-md ${activeSidebar ? 'px-3' : 'px-2 max-md:justify-center'}`"
				>
					<IconCommunity />
					<span :class="`${activeSidebar ? 'block ' : 'max-md:hidden'}`">Dashboard</span>
				</RouterLink>
				<RouterLink
					to="/admin/laporan"
					:class="`flex gap-3 border  dark:border-gray-700 border-gray-300 py-2 rounded-md ${activeSidebar ? 'px-3' : 'px-2 max-md:justify-center'}`"
				>
					<IconEcosystem />
					<span :class="`${activeSidebar ? 'block ' : 'max-md:hidden'}`">Laporan</span>
				</RouterLink>
			</nav>
			<div class="flex items-center leading-3 mb-5 rounded-md justify-center gap-2 border-gray-300 dark:text-neutral-200 border dark:border-gray-700">

				<ThemeButton>Theme</ThemeButton>
			</div>
		</div>
	</aside>
</template>
