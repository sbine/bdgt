const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix.webpackConfig({
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.common.js'
        }
    }
})

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss()],
    })

if (mix.inProduction()) {
    mix.version()
}
