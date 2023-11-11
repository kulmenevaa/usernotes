import Vue from 'vue'
import Vuex from 'vuex'
import * as auth from '../services/auth'
import loading from './modules/loading'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        loading
    },
    state: {
        isLoggedIn: null,
        apiURL: '/api',
        serverPath: '/',
        profile: false
    },
    mutations: {
        authenticate(state, payload) {
            state.isLoggedIn = auth.isLoggedIn();
            if (state.isLoggedIn) {
                state.profile = payload;
            } else {
                state.profile = false;
            }
        }
    },
    actions: {
        authenticate(context, payload) {
            context.commit('authenticate', payload);
        }
    }
})