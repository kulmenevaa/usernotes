import * as auth from '../services/auth'

export default function authorized({ next, store }) {
    if(!auth.isLoggedIn()) {
        return next({name:'login'})
    }
    return next()
}