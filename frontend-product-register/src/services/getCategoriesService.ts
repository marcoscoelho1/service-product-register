import axiosInstance from "../providers/axiosConfig";

export interface Category {
  id: number;
  name: string;
  situation: string;
  created_at?: string;
  updated_at?: string;
}

interface GetCategoriesResponse {
  message: string;
  status: string;
  data: Category[];
}

export const getCategories = async (): Promise<GetCategoriesResponse> => {
  try {
    const response = await axiosInstance.get<GetCategoriesResponse>(
      "/category"
    );
    return response.data;
  } catch (error) {
    throw error;
  }
};
