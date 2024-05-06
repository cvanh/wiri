import Api from "../apiClient";
import CredentailsInterface from "../interfaces/CredentailsInterface";
import UserInterface from "../interfaces/UserInterface";

class ApiModel {
    static async getCsrfToken() {
        await Api().head("/sanctum/csrf-cookie")
    }

    static async getCurrentUser(): Promise<UserInterface> {
        return await Api().get("/api/user")
    }

    static async login(credentials: CredentailsInterface) {
        await this.getCsrfToken();
        return await Api().post("/api/sanctum/token", {
            email: credentials.email,
            password: credentials.password,
            device_name: "asd"
        })
    }

    static async getProducts() {
        // Api().get("/api/user")
        const k = Api().get("/api/product");
        console.log(k)
        return k
    }

}

export default ApiModel