import axiosInstance from "../providers/axiosConfig";

interface Product {
  id: number;
  name: string;
  price: number;
  situation: string;
  category_id: number;
}

interface RegisterProductResponse {
  message: string;
  status: string;
  data: Product;
}

interface RegisterProductParams {
  name: string;
  price: number;
  situation: string;
  category_id: number;
}

export const registerProduct = async (
  payload: RegisterProductParams
): Promise<RegisterProductResponse> => {
  try {
    const response = await axiosInstance.post<RegisterProductResponse>(
      "/products",
      payload
    );
    return response.data;
  } catch (error) {
    throw error;
  }
};
