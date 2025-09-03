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

    },
  },
  plugins: [
  ],
  safelist: []
}
