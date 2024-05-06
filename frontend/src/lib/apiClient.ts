import axios, { Axios, AxiosRequestConfig } from "axios";
import * as SecureStore from "expo-secure-store";

let ApiSingleton = null;

const Api = () => {
  // check if there is already a api instance with the backend
  if (ApiSingleton) {
    return ApiSingleton;
  }
  const config: AxiosRequestConfig = {};
  config.baseURL = "http://localhost:8000";
  config.withCredentials = true;
  config.withXSRFToken = true;
  const NewApiInstance = axios.create(config);

  ApiSingleton = NewApiInstance;
  return ApiSingleton;
};

export default Api;
