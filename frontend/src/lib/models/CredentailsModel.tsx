import * as SecureStore from "expo-secure-store";
import React from "react"
import ApiModel from "./WiriModel";
import CredentailsInterface from "../interfaces/CredentailsInterface";

class CredentailsModel {
    // the key used in the secure storage
    static readonly _credKey = "login_credentials"


    static async set(data: CredentailsInterface) {
        console.info("saving credentials to secure store", data)

        ApiModel.login(data);

        // await SecureStore.setItemAsync(this._credKey, JSON.stringify(data))
    }

    static async get(): Promise<CredentailsInterface | null> {
        return;
        return await SecureStore.getItemAsync(this._credKey)
    }
}

export default CredentailsModel;