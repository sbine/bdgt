var elixir = require('laravel-elixir');

elixir.config.js.uglify.options.compress.drop_console = false;
elixir.config.js.uglify.options.preserveComments = 'license';

var paths = {
    bower: 'bower_components',
    bower_full: '../../../bower_components',

    assets_less: 'resources/assets/less',
    assets_js: 'resources/assets/js',

    css: 'public/css',
    js: 'public/js',
    images: 'public/img',
    fonts: 'public/fonts',
};

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
        .less(
            'app.less',
            paths.css + '/app.min.css'
        )
        .less(
            'bootstrap.less',
            paths.css + '/bootstrap.min.css'
        )

        .scripts([
                paths.bower_full + '/bootstrap/js/alert.js',
                paths.bower_full + '/bootstrap/js/button.js',
                paths.bower_full + '/bootstrap/js/collapse.js',
                paths.bower_full + '/bootstrap/js/dropdown.js',
                paths.bower_full + '/bootstrap/js/modal.js',
                paths.bower_full + '/bootstrap/js/tooltip.js',
                paths.bower_full + '/bootstrap/js/popover.js',
                paths.bower_full + '/bootstrap/js/tab.js',
                paths.bower_full + '/bootstrap/js/transition.js',
            ],
            paths.js + '/bootstrap.min.js'
        )
        .scripts([
                paths.bower_full + '/moment/moment.js',
                paths.bower_full + '/moment-duration-format/lib/moment-duration-format.js',
            ],
            paths.js + '/moment.min.js'
        )
        .scriptsIn(
            'resources/assets/js',
            paths.js + '/app.min.js'
        )

        // Copy dist JS when available
        .copy(
            paths.bower + '/jquery/dist/jquery.min.js',
            paths.js + '/jquery.min.js'
        )
        .copy(
            paths.bower + '/datatables/media/js/jquery.dataTables.min.js',
            paths.js + '/jquery.datatables.min.js'
        )
        .copy(
            paths.bower + '/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js',
            paths.js + '/datatables-bootstrap.min.js'
        )
        .copy(
            paths.bower + '/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js',
            paths.js + '/bootstrap-slider.min.js'
        )
        .copy(
            paths.bower + '/fullcalendar/dist/fullcalendar.min.js',
            paths.js + '/fullcalendar.min.js'
        )
        .copy(
            paths.bower + '/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
            paths.js + '/bootstrap-datepicker.min.js'
        )
        .copy(
            paths.bower + '/Chart.js/dist/Chart.min.js',
            paths.js + '/chart.min.js'
        )
        .copy(
            paths.bower + '/accounting.js/accounting.min.js',
            paths.js + '/accounting.min.js'
        )

        // Copy dist CSS when available
        .copy(
            paths.bower + '/font-awesome/css/font-awesome.min.css',
            paths.css + '/font-awesome.min.css'
        )
        .copy(
            paths.bower + '/datatables/media/css/jquery.dataTables.min.css',
            paths.css + '/jquery.datatables.min.css'
        )
        .copy(
            paths.bower + '/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css',
            paths.css + '/bootstrap-slider.min.css'
        )
        .copy(
            paths.bower + '/fullcalendar/dist/fullcalendar.min.css',
            paths.css + '/fullcalendar.min.css'
        )
        .copy(
            paths.bower + '/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
            paths.css + '/bootstrap-datepicker3.min.css'
        )

        // Compile source CSS for plugins that don't provide dist
        .styles([
                paths.bower_full + '/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'
            ],
            paths.css + '/datatables-bootstrap.min.css'
        )

        // Copy fonts
        .copy(
            paths.bower + '/font-awesome/fonts',
            paths.fonts
        );
});
