/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Livewire/**/*.php",
    "./app/Filament/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        'lazismu-orange': '#F7941D',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
