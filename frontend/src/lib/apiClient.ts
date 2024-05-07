import axios, { Axios, AxiosRequestConfig } from "axios";
import ApiModel from "./models/WiriModel";
import CredentailsModel from "./models/CredentailsModel";

let ApiSingleton;

const Api = (config: AxiosRequestConfig = {}) => {
  // check if there is already a api instance with the backend
  if (ApiSingleton) {
    console.debug("using apisingleton");
    return ApiSingleton;
  }
  console.debug("creating new wiri api instance");

  config.baseURL = "http://localhost:8000";
  config.withCredentials = true;
  config.withXSRFToken = true;

  // TODO make secure
  config.headers = {
    Authorization: `Bearer 1|0I6qSWBoRmbI0szoFEZ8taRWpF6eE1xjxoKUUTdm94af97f1`,
    // Authorization: `Bearer ${CredentailsModel.get()},
  };

  const NewApiInstance = axios.create(config);

  ApiSingleton = NewApiInstance;
  return ApiSingleton;
};

export default Api;
