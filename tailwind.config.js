/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.{php,html,js,vue,blade.php}',
    './src/**/*.php',
    './resources/views/components/**/*.blade.php',
    './resources/views/modals/**/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#eff6ff',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
        }
      }
    },
  },
  plugins: [],
}
