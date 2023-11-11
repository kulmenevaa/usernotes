import guest from '../middleware/guest'
import authorized from '../middleware/authorized'

import Login from '../pages/auth/Login'
import Note from '../pages/note/Index'
import NotFound from '../pages/errors/NotFound'

const routes = [
    {
        path: '/',
        name: 'note',
        component: Note,
        meta: {
            breadcrumb: 'Заметки',
            middleware: [authorized],
        },
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            middleware: [guest]
        }
    },
    {
        path: '*',
        name: '404',
        component: NotFound
    },
]

export default routes