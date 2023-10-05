/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./application/views/*",
    "./application/views/*/*",
  ],
  theme: {
    extend: {
      colors: {
        eblu: {
          100: '#caccd7',
          200: '#b1b5c4',
          300: '#989fb2',
          400: '#8089a0',
          500: '#697691',
          600: '#526581',
          700: '#3c5573',
          800: '#264866',
          900: '#043c5b',
        },
        eyel: {
          100: '#fdf6da',
          200: '#fbf2c7',
          300: '#faedb5',
          400: '#f8e8a3',
          500: '#f7e591',
          600: '#f6df7f',
          700: '#f5dc6f',
          800: '#f3d75e',
          900: '#ffd41f',
        }
      }
    },
  },
  plugins: [],
}