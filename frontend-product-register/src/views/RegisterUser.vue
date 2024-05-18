<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Cadastro</h2>
        <form @submit.prevent="handleRegister">
          <div class="space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
              <input
                v-model="name"
                type="text"
                id="name"
                required
                class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
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
            Já tem uma conta?
            <div>
              <router-link to="/" class="ml-1 text-indigo-600 hover:text-indigo-500"> Entrar</router-link>
            </div>
          </div>
          <div>
            <button
              type="submit"
              class="w-full px-4 py-2 mt-6 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Cadastrar
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent } from 'vue';
  import { useRouter } from 'vue-router';
  import { register } from '../services/registerService';
  
  export default defineComponent({
    data() {
      return {
        name: '',
        email: '',
        password: ''
      };
    },
    setup() {
      const router = useRouter();
      return { router };
    },
    methods: {
      async handleRegister() {
        try {
            const payload = {
                name: this.name,
                email: this.email,
                password: this.password
            }

          const response = await register(payload);


          if(response.data && response.data.id){
            alert('usuario cadastrado com sucesso!');
            this.router.push('/');
          }
        } catch (error) {
          console.error('Erro no registro:', error);
          alert('Falha no registro. Verifique suas informações.');
        }
      }
    }
  });
  </script>

  