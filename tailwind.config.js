const defaultTheme = require('tailwindcss/defaultTheme')

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
      screens: {
        ...defaultTheme.screens,
        xl: '1450px',
      },
    },
  },
}
