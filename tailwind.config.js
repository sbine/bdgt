module.exports = {
  future: {
    purgeLayersByDefault: true,
    removeDeprecatedGapUtilities: true,
  },
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
      maxWidth: {
        '5xl': '66rem',
        '6xl': '76rem',
      },
      screens: {
        xl: '1450px',
      },
    },
  },
}
