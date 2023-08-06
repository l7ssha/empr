import Axios from "axios";
import { API_SERVER } from "./constants";
import { useAuth } from "./auth/useAuth";

const axios = Axios.create({
  baseURL: `${API_SERVER}`,
  headers: { "Content-Type": "application/json" },
});

axios.interceptors.request.use(
  (config) => {
    return Promise.resolve(config);
  },
  (error) => Promise.reject(error),
);

axios.interceptors.response.use(
  (response) => Promise.resolve(response),
  async (error) => {
    const config = error?.config;

    if (error?.response?.status === 401 && !config?.sent) {
      config.sent = true;

      try {
        const { refreshToken } = useAuth();
        const newToken = await refreshToken();

        config.headers["Authorization"] = "Bearer " + newToken;
        return axios(config);
      } catch (e) {
        return Promise.reject(error);
      }
    }

    return Promise.reject(error);
  },
);

export default axios;
