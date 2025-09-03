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
        clipPath: {
          'custom-shape': 'polygon(0 0, 100% 0, 100% 90%, 0 100%)',
        },
      },
    },
    plugins: [
      require('tailwind-clip-path'),
    ],
  safelist: []
}
