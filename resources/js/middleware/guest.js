import * as auth from '../services/auth'

export default function guest({ next, store }){
    if(!auth.isLoggedIn()) {
        return next()
    }
    return next({name:'home'})
}