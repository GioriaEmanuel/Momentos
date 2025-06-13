/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    
  ],
  theme: {
    extend: {
      colors: {
        fondo: '#1E1E1E', //
        fondosecundario:'rgb(49, 50, 51)', 
        titulos: '#E3D3B9', //
        textos: '#C8AC8E',
        
        miColor: {
          DEFAULT: '#ff5733', // Color base
          light: '#ff7f66', // Variante más clara
          dark: '#cc4629' // Variante más oscura
        }
      },
    },
  },
  plugins: [],
}

