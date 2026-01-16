import { defineStore } from 'pinia';
import api from '@/lib/api';
import { ref } from 'vue';
import router from '@/router';

export const useAuthStore = defineStore('auth', {
  // state: {
  //   isAuthenticated: false,
  //   user: null,
  //   msg: null
  // },

	actions: {
		async login(credentials) {
      try{
        const token = await api.get('/sanctum/csrf-cookie', {
          baseURL: 'http://127.0.0.1:8000'
        })

        const res = await api.post('/login', credentials);
        const user = await api.get('/user')

        // this.user = res.data.user;
        // this.isAuthenticated = true;
        localStorage.setItem('user', user)

        // if(token && user) {
        //   // this.msg = 'you already registered'
        //   router.push('/')
        // }
        router.push('/')
        return res;

      } catch (err) {
        console.error(err)
      }
		},

		async logout() {
			await api.post('/logout');
			this.user = null;
			this.isAuthenticated = false;
      localStorage.removeItem('user')
		},

		async checkAuth() {
			try {
				const res = await api.get('/me');
				this.user = res.data;
				this.isAuthenticated = true;
        localStorage.setItem('user', res.data)
			} catch (errs) {
				this.isAuthenticated = false;
				console.error(errs);
			}
		},
	},
});

// export const useAuthStore = defineStore('auth', () => {
//   const user = ref(null)
//   const isLoggin = ref<Boolean>(false)

//   const register = async (req, res) => {
//     try {
//       const registeredUser = await axios
//     }
//   }

// })
