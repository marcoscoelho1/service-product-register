<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center text-gray-700">Cadastro de Produto</h2>
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
            <label for="email" class="block text-sm font-medium text-gray-700">Preço</label>
            <input
              v-model="price"
              type="price"
              id="price"
              required
              class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Situaçao</label>
            <select v-model="situation" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="ativo">
                Ativo
              </option>
              <option value="inativo">
                Inativo
              </option>
            </select>
          </div>
          <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
            <select v-model="categoryId" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
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
import { registerProduct } from '../services/registerProductService';
import { getCategories, Category } from '../services/getCategoriesService';

export default defineComponent({
  data() {
    return {
      name: '',
      price: '',
      categoryId: '',
      situation: 'ativo',
      password: '',
      categories: [] as Category[]
    };
  },
  setup() {
    const router = useRouter();
    return { router };
  },
  async mounted() {
    this.handleGetCategories()
  },
  methods: {
    async handleRegister() {
      try {
          const payload = {
              name: this.name,
              price: parseInt(this.price),
              situation: this.situation,
              category_id: parseInt(this.categoryId),
          }

        const response = await registerProduct(payload);

        if(response.data && response.data.id){
          alert('Produto cadastrado com sucesso!');
          this.router.push('/home');
        }
      } catch (error) {
        console.error('Erro no registro:', error);
        alert('Falha no registro. Verifique suas informações.');
      }
    },

    async handleGetCategories() {
      try{
        const response = await getCategories();

        console.log('categories', response)

        if(response.data){
          this.categories = response.data
        }

      }catch(error){
        console.error('Erro ao buscar categorias:', error);
      }
    }
  }
});
</script>

