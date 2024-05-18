import axiosInstance from "../providers/axiosConfig";

interface Category {
  id: number;
  name: string;
  situation: string;
}

interface RegisterCategoryResponse {
  message: string;
  status: string;
  data: Category;
}

interface RegisterCategory {
  name: string;
  situation: string;
}

export const registerCategory = async (
  payload: RegisterCategory
): Promise<RegisterCategoryResponse> => {
  try {
    const response = await axiosInstance.post<RegisterCategoryResponse>(
      "/category",
      payload
    );
    return response.data;
  } catch (error) {
    throw error;
  }
};
