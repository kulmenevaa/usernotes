import Vue from 'vue'
import Vuetify from 'vuetify'
import ru from 'vuetify/lib/locale/ru'

import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

export default new Vuetify({
    lang: {
        locales: { ru },
        current: 'ru',
    },
})