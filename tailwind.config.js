/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        noto: ["Noto Sans Myanmar", "sans-serif"],
    },
    },
  },
  plugins: [],
}

