<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>
        <form @submit.prevent="handleLogin">
          <div class="space-y-4">
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input
                v-model="email"
                type="email"
                id="email"
                required
                class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
              <input
                v-model="password"
                type="password"
                id="password"
                required
                class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
          </div>
          <div class="flex items-center justify-end mt-6 font-medium text-sm">
            Não é um usuário?
            <div>
              <router-link to="/register" class="ml-1 text-indigo-600 hover:text-indigo-500"> Cadastre-se</router-link>
            </div>
          </div>
          <div>
            <button
              type="submit"
              class="w-full px-4 py-2 mt-6 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Sign in
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { login } from '../services/authService';
  import { useRouter } from 'vue-router';

  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
    setup() {
      const router = useRouter();
      return { router };
    },
    methods: {
      async handleLogin() {
        try {
          const {data} = await login(this.email, this.password);

          console.log(data);

          if(data && data.token){
            window.localStorage.setItem('token', data.token)
          }

          this.router.push('/home')

        }catch(error){
          console.log(error)
          alert('Falha no login. Verifique suas credenciais.');
        }
      }
    }
  };
  </script>
  