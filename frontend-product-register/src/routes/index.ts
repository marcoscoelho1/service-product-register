import { createRouter, createWebHistory } from "vue-router";

import RegisterUser from "../views/RegisterUser.vue";
import Login from "../views/Login.vue";
import Home from "../views/Home.vue";
import RegisterProducts from "../views/RegisterProducts.vue";
import RegisterCategory from "../views/RegisterCategory.vue";

const routes = [
  { path: "/", component: Login },
  { path: "/home", component: Home },
  { path: "/register", component: RegisterUser },
  { path: "/products/new", component: RegisterProducts },
  { path: "/category/new", component: RegisterCategory },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
