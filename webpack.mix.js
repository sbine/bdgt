const mix = require('laravel-mix')

mix.webpackConfig({
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.common.js'
        }
    }
})

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss')
    ])

if (mix.inProduction()) {
    mix.version()
}
