import * as SecureStore from "expo-secure-store";
import React from "react"

class CredentailsModel {
    // the key used in the secure storage
    private static _credKey = "login_credentials"

    static async set(data: CredentailsInterface) {
        console.info("saving credentials to secure store", data)

        await SecureStore.setItemAsync(this._credKey, JSON.stringify(data))
    }

    static async get(): Promise<CredentailsInterface | null> {
        return await SecureStore.getItemAsync(this._credKey)
    }
}

export default CredentailsModel;