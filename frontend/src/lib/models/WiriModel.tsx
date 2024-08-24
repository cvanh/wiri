import axiosInstance from "../axiosInterceptor";
import UserInterface from "../interfaces/UserInterface";

class ApiModel {
    static async getCurrentUser(): Promise<UserInterface> {
        return await axiosInstance.get("/api/user")
    }

    // login and persist jwt
    // static async login(credentials: CredentailsInterface) {
    //     await this.getCsrfToken();
    //     const loginRes = await Api("/sanctum/token", {
    //         email: credentials.email,
    //         password: credentials.password,
    //         device_name: "wiri app"
    //     })

    //     if (loginRes.status !== 200 || !loginRes.data) {
    //         // TODO implement
    //         console.error("error while logging in")
    //     }
    //     credentials.token = loginRes.data
    //     console.log(credentials)

    //     CredentailsModel.set(credentials)
    // }

    static async getProducts() {
        return await axiosInstance.get("/api/product");
    }

}

export default ApiModel