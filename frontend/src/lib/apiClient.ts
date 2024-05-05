import axios, { Axios, AxiosRequestConfig } from "axios";
import * as SecureStore from "expo-secure-store";

const Api = () => {
  const config: AxiosRequestConfig = {};
  config.baseURL = "http://localhost:8000";
  config.withCredentials = true;
  config.withXSRFToken = true;

  return axios.create(config);
};

export default Api;
