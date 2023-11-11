import { http } from '../http'

export function getUsersList() {
    return http().get('/users').then(response => {
        return response.data
    })
}