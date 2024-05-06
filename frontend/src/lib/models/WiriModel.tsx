import Api from "../apiClient";
import CredentailsInterface from "../interfaces/CredentailsInterface";

class ApiModel {
    static getCsrfToken() {
        Api().head("/sanctum/csrf-cookie")
    }

    static login(credentials: CredentailsInterface) {
        this.getCsrfToken();
        Api().post("/login", {
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