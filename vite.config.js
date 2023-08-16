import {defineConfig} from 'vite'
import Icons from 'unplugin-icons/vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    Icons(),
  ],
  server: {

    https: false,

    host: true,

    port: 5173,

    hmr: {host: 'localhost', protocol: 'ws'},

  },
})

