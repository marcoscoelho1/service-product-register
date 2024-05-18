import axiosInstance from "../providers/axiosConfig";

interface LoginResponse {
  token: string;
  user: {
    id: number;
    email: string;
    name: string;
  };
}

export const login = async (
  email: string,
  password: string
): Promise<LoginResponse> => {
  try {
    const response = await axiosInstance.post<LoginResponse>("/session", {
      email,
      password,
    });
    return response.data;
  } catch (error) {
    throw error;
  }
};
