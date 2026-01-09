<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useAuthStore } from '@/stores/auth';

// const errs = ref(null);
const isLoading = ref();
const { login } = useAuthStore()

const form = reactive({
	email: '',
	password: '',
});

</script>
<template>
	<div

		class="fixed top-7 right-5 flex flex-col gap-2"
	>
		<!-- <span
			v-for="(messages, field) in errs.errors"
			:key="field"
			class="px-5 py-2 bg-red-500/40 text-sm rounded-full shadow-md"
		>
			{{ messages[0] }}
		</span> -->
	</div>
	<main class="flex h-screen items-center justify-center bg-neutral-200 text-neutral-700">
		<RouterLink
			to="/"
			class="fixed top-5 left-5 underline text-blue-500"
		>
			back home
		</RouterLink>
		<form
			@submit.prevent="login(form)"
			class="flex flex-col gap-3 p-10 rounded-lg shadow-lg shadow-black/10 w-[clamp(320px,400px,500px)] bg-neutral-100"
		>
			<h3 class="text-center text-2xl font-semibold leading-6">Login</h3>
			<div class="flex flex-col gap-1">
				<label for="email">Email</label>
				<input
					name="email"
					id="email"
					v-model="form.email"
					type="email"
					placeholder="johndoe@example.com"
					class="border border-neutral-400 rounded-sm py-1.5 px-3 text-sm focus:ring-0 focus:outline"
				/>
			</div>
			<div class="flex flex-col gap-1">
				<label for="password">Password</label>
				<input
					name="password"
					id="password"
					v-model="form.password"
					type="password"
					placeholder="your password..."
					autocomplete="off"
					class="border border-neutral-400 rounded-sm py-1.5 px-3 text-sm focus:ring-0 focus:outline"
				/>
			</div>

			<button
				type="submit"
				:disabled="isLoading"
				class="py-1.75 rounded-md bg-neutral-600 hover:bg-neutral-700 duration-300 cursor-pointer text-white mt-3"
			>
				{{ isLoading ? 'loggin In...' : 'login' }}
			</button>
		</form>
	</main>
</template>
