/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{js,jsx,ts,tsx}"],
  theme: {
    extend: {
      colors:{
        color: {
          menime: '#E50914',
          merah: '#CD2026',
          hijau: '#5EBA7D',
          kuning: '#F0AD4E',
          biru: '#337AB7',
          hitam: '#0F0F0F',
          abu: '#333333',
          putih: '#f7f7f7'
        }
      }
    },
  },
  plugins: [],
}

