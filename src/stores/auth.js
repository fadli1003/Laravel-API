import { defineStore } from 'pinia'
import api from '@/lib/api'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    isAuthenticated: false
  }),

  actions: {
    async login(credentials) {
      const res = await api.post('/auth/login', credentials)
      this.user = res.data.user
      this.isAuthenticated = true
      return res
    },

    async logout() {
      await api.post('/auth/logout')
      this.user = null
      this.isAuthenticated = false
    },

    async checkAuth() {
      try {
        const res = await api.get('/auth/me')
        this.user = res.data
        this.isAuthenticated = true
      } catch {
        this.isAuthenticated = false
      }
    }
  }
})
