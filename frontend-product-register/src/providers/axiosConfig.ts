import axios from "axios";

const instance = axios.create({
  baseURL: "http://localhost:8080/api",
  timeout: 1000,
  headers: { "Content-Type": "application/json" },
});

// Adicionar interceptores se necessário
instance.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

instance.interceptors.response.use(
  (response) => JSON.parse(JSON.stringify(response)),
  (error) => Promise.reject(error)
);

export default instance;
