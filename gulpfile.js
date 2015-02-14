var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .less(['whoops.less'])
        .less('app.less', 'resources/.build/css')
        .copy('resources/assets/js', 'resources/.build/js')
        .copy('bower_components/seiyria-bootstrap-slider/js/bootstrap-slider.js', 'resources/.build/js/bootstrap-slider.js')
        .copy('bower_components/seiyria-bootstrap-slider/css/bootstrap-slider.css', 'resources/.build/css/bootstrap-slider.css')
        .stylesIn('resources/.build/css', 'public/css/app.css')
        .scriptsIn('resources/.build/js', 'public/js/app.js');
});
