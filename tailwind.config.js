import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        brand: {
          // Primary colors
          'primary-300': '#99dbff',
          'primary-400': '#4dbfff',
          'primary-500': '#00a4ff',
          'primary-600': '#0073b3',
          'primary-700': '#015f91',
          // Secondary colors
          'secondary-300': '#bdc8cd',
          'secondary-400': '#8c9ea8',
          'secondary-500': '#5b7583',
          'secondary-600': '#40525c',
          'secondary-700': '#242f34',
        },
      },
      minHeight: {
        'calc-screen-140': 'calc(100vh - 140px)',
      },
    },
  },

  plugins: [forms],
}
