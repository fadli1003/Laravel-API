import './assets/main.css'

import { createApp } from 'vue'
import App from '@/App.vue'
import router from '@/router'
import { createPinia } from 'pinia'


// const root = document.documentElement

// const savedTheme = localStorage.getItem('theme')

// if (savedTheme === 'dark') {
//   root.classList.add('dark')
// } else {
//   root.classList.remove('dark')
// }

const app = createApp(App)

app.use(router)
app.use(createPinia())
app.mount('#app')
