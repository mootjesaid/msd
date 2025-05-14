/** @type {import('tailwindcss').Config} */
const plugin = require("flowbite/plugin");
module.exports = {
  content: [
    "./vendor/tales-from-a-dev/flowbite-bundle/templates/**/*.html.twig",
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./src/Twig/Components/**/*.php"
  ],
  theme: {
    extend: {
      maxWidth: {
        'screen-90': '85%',
      },
      colors: {
        primary: '#1f2937',     // Example: dark slate
        secondary: '#333',   // Example: light gray
        accent: '#c19a5b',      // Your gold color
        base: '#f5f0e6',
      },
      fontFamily: {
        'body': [
          'Inter',
          'ui-sans-serif',
          'system-ui',
          '-apple-system',
          'system-ui',
          'Segoe UI',
          'Roboto',
          'Helvetica Neue',
          'Arial',
          'Noto Sans',
          'sans-serif',
          'Apple Color Emoji',
          'Segoe UI Emoji',
          'Segoe UI Symbol',
          'Noto Color Emoji'
        ],
        'sans': [
          'Inter',
          'ui-sans-serif',
          'system-ui',
          '-apple-system',
          'system-ui',
          'Segoe UI',
          'Roboto',
          'Helvetica Neue',
          'Arial',
          'Noto Sans',
          'sans-serif',
          'Apple Color Emoji',
          'Segoe UI Emoji',
          'Segoe UI Symbol',
          'Noto Color Emoji'
        ]
      }
    },
    plugins: [
      require('flowbite/plugin'),
      plugin(function ({addVariant}) {
        addVariant('turbo-frame', 'turbo-frame[src] &');
        addVariant('modal', 'dialog &');
      }),
    ],
  }
}
