var elixir = require('laravel-elixir');

elixir.config.js.uglify.options.compress.drop_console = false;
elixir.config.js.uglify.options.preserveComments = 'license';

var paths = {
    node: 'node_modules',
    node_full: '../../../node_modules',

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
                paths.node_full + '/bootstrap/js/alert.js',
                paths.node_full + '/bootstrap/js/button.js',
                paths.node_full + '/bootstrap/js/collapse.js',
                paths.node_full + '/bootstrap/js/dropdown.js',
                paths.node_full + '/bootstrap/js/modal.js',
                paths.node_full + '/bootstrap/js/tooltip.js',
                paths.node_full + '/bootstrap/js/popover.js',
                paths.node_full + '/bootstrap/js/tab.js',
                paths.node_full + '/bootstrap/js/transition.js',
            ],
            paths.js + '/bootstrap.min.js'
        )
        .scripts([
                paths.node_full + '/moment/moment.js',
                paths.node_full + '/moment-duration-format/lib/moment-duration-format.js',
            ],
            paths.js + '/moment.min.js'
        )
        .scriptsIn(
            'resources/assets/js',
            paths.js + '/app.min.js'
        )

        // Copy dist JS when available
        .copy(
            paths.node + '/jquery/dist/jquery.min.js',
            paths.js + '/jquery.min.js'
        )
        .copy(
            paths.node + '/datatables/media/js/jquery.dataTables.min.js',
            paths.js + '/jquery.datatables.min.js'
        )
        .copy(
            paths.node + '/datatables.net-bs/js/dataTables.bootstrap.js',
            paths.js + '/datatables-bootstrap.min.js'
        )
        .copy(
            paths.node + '/bootstrap-slider/dist/bootstrap-slider.min.js',
            paths.js + '/bootstrap-slider.min.js'
        )
        .copy(
            paths.node + '/fullcalendar/dist/fullcalendar.min.js',
            paths.js + '/fullcalendar.min.js'
        )
        .copy(
            paths.node + '/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
            paths.js + '/bootstrap-datepicker.min.js'
        )
        .copy(
            paths.node + '/chartjs/chart.js',
            paths.js + '/chart.min.js'
        )
        .copy(
            paths.node + '/accounting-js/dist/accounting.umd.js',
            paths.js + '/accounting.min.js'
        )

        // Copy dist CSS when available
        .copy(
            paths.node + '/font-awesome/css/font-awesome.min.css',
            paths.css + '/font-awesome.min.css'
        )
        .copy(
            paths.node + '/datatables/media/css/jquery.dataTables.min.css',
            paths.css + '/jquery.datatables.min.css'
        )
        .copy(
            paths.node + '/bootstrap-slider/dist/css/bootstrap-slider.min.css',
            paths.css + '/bootstrap-slider.min.css'
        )
        .copy(
            paths.node + '/fullcalendar/dist/fullcalendar.min.css',
            paths.css + '/fullcalendar.min.css'
        )
        .copy(
            paths.node + '/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
            paths.css + '/bootstrap-datepicker3.min.css'
        )

        // Compile source CSS for plugins that don't provide dist
        .styles([
                paths.node_full + '/datatables.net-bs/css/dataTables.bootstrap.css'
            ],
            paths.css + '/datatables-bootstrap.min.css'
        )

        // Copy fonts
        .copy(
            paths.node + '/font-awesome/fonts',
            paths.fonts
        );
});
