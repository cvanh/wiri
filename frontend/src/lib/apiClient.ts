import axios from "axios";
import * as SecureStore from "expo-secure-store";

const Api = async (config: any) => {
  //   const login = SecureStore.setItemAsync("login_credentials", "");
  await SecureStore.getItemAsync("login_credentials");
  config.baseUrl = "http://localhost:8000";

  return axios(config);
};

export default Api;
