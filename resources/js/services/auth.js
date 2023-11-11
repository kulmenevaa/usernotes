import { http } from '../http'
import store from '../store'

export function login(user) {
    return http().post('/user/login', user).then(response => {
        if(response.status === 200) {
            localStorage.setItem('auth-token', JSON.stringify(response.data.token))
            store.dispatch('authenticate', response.data.user)
        }
        return response.data
    })
}

export function logout() {
    http().get('/user/logout')
    localStorage.removeItem('auth-token')
    store.dispatch('authenticate', false)
}

export function getProfile() {
    return http().get('/user/profile').then(response => {
        return response.data
    })
}

export function isLoggedIn() {
    const token = localStorage.getItem('auth-token')
    return token != null;
}

export function getAccessToken() {
    const token = localStorage.getItem('auth-token')
    if(!token) {
        return null
    }
    const tokenData = JSON.parse(token)
    return tokenData
}