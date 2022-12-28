require('./bootstrap');

import { createApp } from 'vue'
import App from './components/App.vue'

export const eventBus = createApp(App)

createApp(App).mount('#app')

Vue.component('app',require('./components/App').default)

