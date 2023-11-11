import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import routes from './routes'

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
    routes
})

router.beforeEach((to, from, next) => {
    if(!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware;
    const context = {
        to,
        from,
        next,
        //store
    }
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
})

function middlewarePipeline(context, middleware, index) {
    const nextMiddleware = middleware[index]
    if(!nextMiddleware) {
        return context.next 
    }
    return () => {
        const nextPipeline = middlewarePipeline(context, middleware, index + 1)
        nextMiddleware({ ...context, nextMiddleware: nextPipeline })
    }
}

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch(err => err)
};

export default router