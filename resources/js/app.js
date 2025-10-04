import './bootstrap'
import Vue from 'vue/dist/vue'

/**
 * Vue Internationalization/Translations
 */
import languageBundle from './i18n'
import VueI18n from 'vue-i18n'
Vue.use(VueI18n)

const i18n = new VueI18n({
  locale: window.Locale,
  messages: languageBundle,
})

/**
 * Font Awesome
 */
import { library, config, dom } from '@fortawesome/fontawesome-svg-core'
import {
  faCaretDown,
  faCaretUp,
  faChartBar,
  faCheck,
  faChevronLeft,
  faChevronRight,
  faCircle,
  faDollarSign,
  faPencilAlt,
  faPlus,
  faSort,
  faSortDown,
  faSortUp,
  faTimes,
} from '@fortawesome/free-solid-svg-icons'
import { faCalendar, faCheckSquare, faClock, faEnvelope, faFlag } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon, FontAwesomeLayers } from '@fortawesome/vue-fontawesome'

library.add(
  faCaretDown,
  faCaretUp,
  faChartBar,
  faCheck,
  faChevronLeft,
  faChevronRight,
  faCircle,
  faDollarSign,
  faPencilAlt,
  faPlus,
  faSort,
  faSortDown,
  faSortUp,
  faTimes,
  faCalendar,
  faCheckSquare,
  faClock,
  faEnvelope,
  faFlag
)

/**
 * Ensure vue-tables-2 sorting icons can be replaced with font-awesome chevrons
 */
config.autoReplaceSvg = 'nest'
dom.watch()

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('font-awesome-layers', FontAwesomeLayers)

/**
 * Vue-Tables-2
 */
import { ClientTable } from 'vue-tables-2'
import TailwindTheme from './themes/vue-tables-tailwind-theme'
Vue.use(
  ClientTable,
  {
    sortIcon: {
      is: 'fa-sort',
      base: 'fas',
      up: 'fa-sort-up',
      down: 'fa-sort-down',
    },
  },
  false,
  TailwindTheme
)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = import.meta.glob('./**/*.vue')
Object.keys(files).map((key) => Vue.component(key.split('/').pop().split('.')[0], files[key]))

const app = new Vue({
  el: '#app',
  i18n,
})
