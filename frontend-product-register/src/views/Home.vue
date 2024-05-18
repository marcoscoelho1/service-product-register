<template>
  <div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-2xl font-bold mb-8">Lista de Produtos</h1>
      <div class="flex gap-4">
        <router-link to="/category/new" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Nova Categoria
        </router-link>
        <router-link to="/products/new" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Novo Produto
        </router-link>
      </div>
    </div>
    <div v-if="loading" class="text-center">Carregando...</div>
    <div v-else-if="error" class="text-center text-red-500">Erro ao carregar produtos.</div>
    <div v-else>
      <div class="flex justify-end gap-8 text-2xl font-bold mb-8">
        <div>
          <label for="perPageSelected" class="block text-sm font-medium text-gray-700">Items por página</label>
          <select id='perPageSelected' v-model="perPageSelected" class="block px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @change="handleFilterChange">
            <option v-for="perPage in [2,10,50,100]" :key="perPage" :value="perPage">
              {{ perPage }}
            </option>
              </select>
        </div>
        <div>
          <label for="currentPage" class="block text-sm font-medium text-gray-700">Página</label>
          <select id='currentPage' v-model="currentPage" class="block px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @change="handleFilterChange">
            <option v-for="page in Array.from({ length: pagination.total_pages }, (_, index) => index + 1)" :key="page" :value="page">
              {{ page }}
            </option>
              </select>
        </div>
        <div>
          <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
          <select v-model="selectedCategory" id='category' class="block px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @change="handleFilterChange">
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
              </select>
        </div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div v-for="product in products" :key="product.id" class="bg-white p-4 rounded-lg shadow-md">
          <img :src="getImageUrl(product.image)" alt="Product Image" class="w-full h-48 object-cover rounded-t-lg">
          <div class="mt-4">
            <h2 class="text-lg font-semibold">{{ product.name }}</h2>
            <p class="text-gray-600">{{ product.category.name }}</p>
            <div class="mt-4">
              <span class="text-xl font-bold text-indigo-600">R$ {{ product.price.toFixed(2) }}</span>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { getProducts, Product, Pagination } from '../services/getProductsService';
import DefaultProductImage from '../assets/images/sem_foto.png';
import { Category, getCategories } from '../services/getCategoriesService';
import { textChangeRangeIsUnchanged } from 'typescript';

export default defineComponent({
  data() {
    return {
      products: [] as Product[],
      selectedCategory: 0 as number,
      perPageSelected: 10,
      currentPage: 1,
      categories: [] as Category[],
      loading: true,
      error: null as string | null,
      pagination: {} as Pagination,
    };
  },
  async mounted() {
    this.handleGetCategories();
    this.handleGetProducts();
  },
  methods: {
    async handleGetProducts() {
      try {
        const params = {
          per_page: this.perPageSelected,
          page: this.currentPage,
          category_id: this.selectedCategory
        }


        const response = await getProducts(params);
        this.products = response.data;
        this.pagination = response.pagination;
      } catch (err) {
        this.error = 'Erro ao buscar produtos';
      } finally {
        this.loading = false;
      }
    },
    handleFilterChange(event: any){
      if(event.currentTarget && event.currentTarget.id !== 'currentPage'){
        this.currentPage = 1
      }

      this.handleGetProducts()
    },
    async handleGetCategories() {
      try{
        const response = await getCategories();

        const allCategories: Category = {
          id: 0,
          name: 'Todas',
          situation: 'active'
        }

        if(response.data){
          this.categories = [ allCategories,...response.data]
        }

      }catch(error){
        console.error('Erro ao buscar categorias:', error);
      }
    },
    getImageUrl(imageUrl: string) {
      return imageUrl || DefaultProductImage;
    }
  }
});
</script>
