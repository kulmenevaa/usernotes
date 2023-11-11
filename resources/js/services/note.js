import { http } from '../http'

export function getNotesList() {
    return http().get('/notes').then(response => {
        return response.data
    })
}

export function deleteNote(id) {
    return http().delete('/notes/' + id).then(response => {
        return response.data
    });
}

export function createNote(data) {
    return http().post('/notes', data).then(response => {
        return response.data
    })
}

export function updateNote(id, data) {
    return http().post('/notes/' + id, data).then(response => {
        return response.data
    })
}
