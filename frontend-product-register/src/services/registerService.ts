import axiosInstance from "../providers/axiosConfig";

interface RegisterResponse {
  message: string;
  status: string;
  data: {
    name: string;
    email: string;
    updated_at: string;
    created_at: string;
    id: number;
  };
}

interface RegisterParams {
  name: string;
  email: string;
  password: string;
}

export const register = async (
  payload: RegisterParams
): Promise<RegisterResponse> => {
  try {
    const response = await axiosInstance.post<RegisterResponse>(
      "/users",
      payload
    );
    return response.data;
  } catch (error) {
    throw error;
  }
};
