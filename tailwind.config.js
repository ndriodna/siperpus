module.exports = {
  purge: [
  './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  './storage/framework/views/*.php',
  './resources/**/*.blade.php',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      opacity: ['disabled'],
    },
  },
  plugins: [
   require('daisyui'),
  ],

  // config (optional)
    daisyui: {
      styled: true,
      themes: true,
      base: true,
      utils: true,
      logs: true,
      rtl: false,
    },
}
