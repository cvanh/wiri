import axios, { AxiosRequestConfig } from "axios";
import CredentailsModel from "./models/CredentailsModel";
import { createContext } from "react";

const ApiContext = createContext(null);

export function ApiProvider({ children }) {
  const apiClient = async (config: AxiosRequestConfig = {}) => {
    config.baseURL = "http://localhost:8000";
    config.withCredentials = true;
    config.withXSRFToken = true;

    const credentails = await CredentailsModel.get();
    config.headers = {
      Authorization: `Bearer ${credentails.token}`,
    };

    return axios.create(config);
  };

  return <ApiContext.Provider value={{ apiClient }}>
    {children}</ApiContext.Provider>;
}
export const ApiConsumer = ApiContext.Consumer;
export default ApiContext;