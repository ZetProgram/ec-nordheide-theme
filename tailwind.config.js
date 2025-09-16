/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./blocks/**/*.php",
    "./lib/**/*.php",
    "./assets/js/**/*.{js,ts}",
    "./timeline/**/*.php",
    "./theme.json",
    "./*.html"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        goldney: ['Goldney', 'serif'],
      },
    },
  },
  plugins: [
  ],
  safelist: []
}
