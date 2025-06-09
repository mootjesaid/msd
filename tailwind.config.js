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
      borderColor: {
        secondary: '#BF9264',
      },
      colors: {
        primary: '#1B4D3E',     // Deep Islamic green
        secondary: '#BF9264',   // Rich brown
        accent: '#C3922E',      // Golden color (representing Islamic art)
        base: '#F7F1E5',        // Warm cream color
        text: {
          light: '#F7F1E5',     // Light text
          dark: '#2D3748',      // Dark text
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
