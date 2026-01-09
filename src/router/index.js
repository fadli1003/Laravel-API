import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import AdminDashboard from '@/views/admin/AdminDashboard.vue'
import LaporanView from '@/views/admin/LaporanView.vue'
import LoginApp from '@/views/auth/LoginApp.vue'
import AppRegister from '@/views/auth/AppRegister.vue'
import ProfilePage from '@/views/auth/ProfilePage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginApp,
    },
    {
      path: '/register',
      name: 'register',
      component: AppRegister,
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('@/views/AboutView.vue'),
    },
    {
      path: '/admin/dashboard',
      name: 'Dashboard Admin',
      component: AdminDashboard,
    },
    {
      path: '/admin/laporan',
      name: 'laporan',
      component: LaporanView,
    },
    {
      path: '/me',
      name: 'profile',
      component: ProfilePage
    }

  ],
})

export default router

// import { createRouter, createWebHistory } from 'vue-router'
// import { useAuthStore } from '@/stores/auth'

// const routes = [
//   { path: '/', component: () => import('@/views/HomeView.vue') },
//   { path: '/login', component: () => import('@/views/LoginView.vue') },
//   {
//     path: '/admin',
//     component: () => import('@/views/AdminView.vue'),
//     meta: { requiresAuth: true }
//   }
// ]

// const router = createRouter({
//   history: createWebHistory(),
//   routes
// })

// // Navigation guard
// router.beforeEach((to) => {
//   const auth = useAuthStore()
//   if (to.meta.requiresAuth && !auth.isAuthenticated) {
//     return '/login'
//   }
// })

// export default router
