import store from './store'
import axios from 'axios'
import * as auth from './services/auth'

import { createToastInterface } from 'vue-toastification';

export function http() {
    const globalToast = createToastInterface({
        maxToasts: 20,
        newestOnTop: false,
        position: "bottom-right",
        timeout: 3000,
        closeOnClick: true,
        pauseOnFocusLoss: false,
        pauseOnHover: false,
        draggable: false,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: false,
        closeButton: "button",
        icon: true
    })

    const api = axios.create({
        baseURL: store.state.apiURL,
        headers: {
            Authorization: 'Bearer ' + auth.getAccessToken(),
        }
    })

    api.interceptors.request.use(config => {
        store.commit('loading/setLoading', true)
        return config
    })
    
    api.interceptors.response.use(response => {
        store.commit('loading/setLoading', false)
        return Promise.resolve(response)
    }, error => {
        store.commit('loading/setLoading', false)
        switch(error.response.status) {
            case 422:
                var list = ''
                Object.values(error.response.data.errors).forEach(function(value) {
                    list += value[0] + "\r\n"
                })
                globalToast.error(list)
                break
            default:
                globalToast.error(error.response.data.message)
        }
        return Promise.reject(error)
    })

    return api
}

export function httpFile() {
    return axios.create({
        baseURL: store.state.apiURL,
        headers: {
            Authorization: 'Bearer ' + auth.getAccessToken(),
            'Content-Type': 'multipart/form-data'
        }
    });
}