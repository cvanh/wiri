import axios, { Axios, AxiosRequestConfig } from "axios";
import ApiModel from "./models/WiriModel";

let ApiSingleton;

const Api = (config: AxiosRequestConfig = {}) => {
  // check if there is already a api instance with the backend
  if (ApiSingleton) {
    console.info("using apisingleton");
    return ApiSingleton;
  }
  console.info("creating new wiri api instance");

  config.baseURL = "http://localhost:8000";
  config.withCredentials = true;
  config.withXSRFToken = true;

  // TODO make secure
  config.headers = {
    Authorization: `Bearer 1|nvjECkyMt5bHilsADWWWBgstEF1rqm3YO5UWXP8Jf8815309`,
  };

  const NewApiInstance = axios.create(config);

  ApiSingleton = NewApiInstance;
  return ApiSingleton;
};

export default Api;
