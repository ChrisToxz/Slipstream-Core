/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios'
import Echo from 'laravel-echo'
import {SnackbarService} from 'vue3-snackbar'
import 'vue3-snackbar/styles'

import Pusher from 'pusher-js'

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
window.Pusher = Pusher


window.Echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.VITE_PUSHER_APP_KEY ?? 'app-key',
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
  wsHost: `socket.${window.location.host}`,
  wsPort: 80,
  wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
  forceTLS: false,
  enabledTransports: ['ws'],
})

const ws = window.Echo.connector.pusher.connection



ws.bind('connected', () => {
  console.log('Websocket connected!')
})
ws.bind('unavailable', () => {
  console.error('Websocket connection lost')
  $snackbar.add({
    type: 'warning',
    text: 'Connection lost...',
  })
})
