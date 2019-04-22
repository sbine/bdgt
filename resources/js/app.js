require('./bootstrap')

window.Vue = require('vue')

/**
 * Font Awesome
 */
import { library, config, dom } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon, FontAwesomeLayers } from '@fortawesome/vue-fontawesome'

library.add(fas, far)

/**
 * Ensure vue-tables-2 sorting icons can be replaced with font-awesome chevrons
 */
config.autoReplaceSvg = 'nest'
dom.watch()

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('font-awesome-layers', FontAwesomeLayers)

/**
 * Portal-Vue
 */
import PortalVue from 'portal-vue'
Vue.use(PortalVue)

/**
 * V-Calendar
 */
import VCalendar from 'v-calendar'
Vue.use(VCalendar)

/**
 * Vue-Tables-2
 */
import { ClientTable } from 'vue-tables-2'
import TailwindTheme from './themes/vue-tables-tailwind-theme'
Vue.use(ClientTable, {
    sortIcon: {
        is: 'fa-sort',
        base: 'fas',
        up: 'fa-sort-up',
        down: 'fa-sort-down'
    }
}, false, TailwindTheme)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app'
})
