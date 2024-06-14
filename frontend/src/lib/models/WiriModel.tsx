import Api from "../apiClient";
import CredentailsInterface from "../interfaces/CredentailsInterface";
import UserInterface from "../interfaces/UserInterface";
import CredentailsModel from "./CredentailsModel";

class ApiModel {
    static async getCsrfToken() {
        await Api().head("/sanctum/csrf-cookie")
    }

    static async getCurrentUser(): Promise<UserInterface> {
        return await Api().get("/api/user")
    }

    // login and persist jwt
    static async login(credentials: CredentailsInterface) {
        await this.getCsrfToken();
        const loginRes = await Api("/sanctum/token", {
            email: credentials.email,
            password: credentials.password,
            device_name: "wiri app"
        })

        if (loginRes.status !== 200 || !loginRes.data) {
            // TODO implement
            console.error("error while logging in")
        }
        credentials.token = loginRes.data
        console.log(credentials)

        CredentailsModel.set(credentials)
    }

    static async getProducts() {
        return await Api().get("/api/product");
    }

}

export default ApiModel