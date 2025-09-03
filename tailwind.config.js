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
  theme: { extend: {} },
  plugins: [],
  safelist: [
    // hier Klassen whitelisten, die dynamisch aus der DB kommen (ACF, Menüs, o.ä.)
    // z.B. /^grid-cols-/, /^md:grid-cols-/, "is-active"
  ]
}
