import axios, { Axios, AxiosRequestConfig } from "axios";
import ApiModel from "./models/WiriModel";
import CredentailsModel from "./models/CredentailsModel";

let ApiSingleton;

const Api = (config: AxiosRequestConfig = {}) => {
  // check if there is already a api instance with the backend
  // if (ApiSingleton) {
  //   console.debug("using apisingleton");
  //   return ApiSingleton;
  // }
  // console.debug("creating new wiri api instance");

  config.baseURL = "http://localhost:8000";
  config.withCredentials = true;
  config.withXSRFToken = true;

  const credentails = CredentailsModel.get();
  console.log("kaas", credentails);
  config.headers = {
    Authorization: `Bearer ${credentails.token}`,
  };

  const NewApiInstance = axios.create(config);

  ApiSingleton = NewApiInstance;
  return ApiSingleton;
};

export default Api;
