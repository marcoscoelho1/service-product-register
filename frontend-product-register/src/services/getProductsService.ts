import axiosInstance from "../providers/axiosConfig";

interface Category {
  id: number;
  name: string;
  situation: string;
  created_at: string;
  updated_at: string;
}

export interface Product {
  id: number;
  name: string;
  price: number;
  image: string;
  situation: string;
  category_id: number;
  created_at: string;
  updated_at: string;
  category: Category;
}

export interface Pagination {
  total: number;
  per_page: number;
  current_page: number;
  total_pages: number;
}

interface GetProductsResponse {
  message: string;
  status: string;
  data: Product[];
  pagination: Pagination;
}

interface GetProductsFilters {
  per_page?: number;
  page?: number;
  category_id?: number;
}

export const getProducts = async (
  params?: GetProductsFilters
): Promise<GetProductsResponse> => {
  try {
    const response = await axiosInstance.get<GetProductsResponse>("/products", {
      params,
    });
    return response.data;
  } catch (error) {
    throw error;
  }
};
