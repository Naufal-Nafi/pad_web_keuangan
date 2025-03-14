/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/view/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      animation: {
        gradientShift: "gradientShift 0.5s ease-in-out",
      },
      keyframes: {
        gradientShift: {
          "0%": { background: "linear-gradient(to right, #161D6F, #4854EB)" },
          "100%": { background: "linear-gradient(to left, #161D6F, #4854EB)" }
        }
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}