module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/js/components/**/*.vue',
    './resources/sass/**/*.scss',
  ],
  theme: {
    extend: {
      borderWidth: {
        '3': '3px',
      },
    },
  },
}
