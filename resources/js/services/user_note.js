import { http } from '../http'

export function shareUserNote(data) {
    return http().post('/user_note/share', data).then(response => {
        return response.data
    })
}