import Api from "../apiClient";
import CredentailsInterface from "../interfaces/CredentailsInterface";

class ApiModel {
    static login(credentials: CredentailsInterface) {
        Api().post("/login", {
            email: credentials.email,
            password: credentials.password
        })

    }
    static async getProducts() {
        return Api().get("/api/product");
    }

}

export default ApiModel