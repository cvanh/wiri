import Api from "../apiClient";
import CredentailsInterface from "../interfaces/CredentailsInterface";
import UserInterface from "../interfaces/UserInterface";

class ApiModel {
    static getCsrfToken() {
        Api().head("/sanctum/csrf-cookie")
    }

    static async getCurrentUser(): Promise<UserInterface> {
        return await Api().get("/api/user")
    }

    static async login(credentials: CredentailsInterface) {
        this.getCsrfToken();
        await Api().post("/login", {
            email: credentials.email,
            password: credentials.password
        })
    }

    static async getProducts() {
        Api().get("/api/user")
        const k = Api().get("/api/product");
        console.log(k)
        return k
    }

}

export default ApiModel