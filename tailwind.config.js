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
      colors: {
        primary: '#2C3930',      // Olive green
        secondary: '#3F4F44',    // Dark green
        base: '#DCD7C9',
        accent: '#A27B5C',       // Accent color (tan)
        black: '#000000',
        text: {
          DEFAULT: '#283618',    // Text color
          light: '#FEFAE0',
        }
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
