import axios from 'axios'
import CredentailsModel from './models/CredentailsModel'

const axiosInstance = axios.create({
    baseURL: 'http://192.168.2.8:8080',
    withCredentials: true,
    withXSRFToken: true,
})

axiosInstance.interceptors.request.use(
    async (config) => {
        // TODO make shure this only is set on the requests to the api
        const credentials = await CredentailsModel.get()
        if (credentials) {
            config.headers.Authorization = `Bearer ${credentials.token}`
        }

        return config
    },

)

axiosInstance.interceptors.response.use(
    (response) => {
        return response
    },
    (error) => {
        console.error("request failed", error)
        if (error.response && error.response.status === 401) {
            console.log('call the refresh token api here')
            // Handle 401 error, e.g., redirect to login or refresh token
        }
        return Promise.reject(error)
    },
)

export default axiosInstance