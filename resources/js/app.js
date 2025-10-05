import './bootstrap'
import { createApp } from 'vue'

const app = createApp({})

/**
 * Vue Internationalization/Translations
 */
// Generate this file using `npm run i18n`
import languageBundle from './i18n'
import { createI18n } from 'vue-i18n'

const i18n = createI18n({
  legacy: false,
  locale: window.Locale,
  messages: languageBundle,
})

app.use(i18n)

/**
 * Font Awesome
 */
import { library } from '@fortawesome/fontawesome-svg-core'
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
  faSearch,
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
  faSearch,
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

app.component('font-awesome-icon', FontAwesomeIcon)
app.component('font-awesome-layers', FontAwesomeLayers)

/**
 * DataTables
 */
import PrimeVue from 'primevue/config'
import Lara from '@primevue/themes/lara'

app.use(PrimeVue, {
  theme: {
    preset: Lara,
    options: {
      darkModeSelector: '.dark-mode',
    },
  },
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = Object.entries(import.meta.glob('./**/*.vue', { eager: true }))
files.forEach(([path, module]) => app.component(path.split('/').pop().split('.')[0], module.default))

app.mount('#app')
