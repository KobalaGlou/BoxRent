import '../css/app.css';
import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import Layout from './Layouts/AppLayout.vue'
import '@fortawesome/fontawesome-free/css/all.min.css'

import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { Ziggy } from './ziggy'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: async name => {
    const page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
    return page
  },
  setup({ el, App, props, plugin }) {
    const vueApp = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)

    vueApp.mount(el)

    el.removeAttribute('data-page') 

    return vueApp
  },
  progress: {
    color: '#4B5563',
  },
})
