const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
const webpack = require('webpack')

mix.webpackConfig({
   plugins: [
      new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
   ]
})

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .options({
      processCssUrls: false,
      postCss: [ tailwindcss() ],
   })
