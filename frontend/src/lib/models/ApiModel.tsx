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
        const k = await Api().get("/api/product");
        console.log(k)
        return k
    }

}

export default ApiModel