import './bootstrap'
import '../css/app.css'

import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers'
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m'
import {SnackbarService} from 'vue3-snackbar'
import 'vue3-snackbar/styles'
import FloatingVue from 'floating-vue'
import 'floating-vue/dist/style.css'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(SnackbarService)
      .use(FloatingVue,{
        themes: {
          tooltip: {
            delay: {
              show:100,
              delay:100,
            },
          },
        },
      })
      .mount(el)
  },
  progress: {
    delay: 100,
    color: '#0073C7',
    showSpinner: true,
  },
})
