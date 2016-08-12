<?php

namespace Bdgt\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($expression) {
            return "<?php echo '$ ' . number_format({$expression}, 2); ?>";
        });

        Blade::directive('number', function ($expression) {
            return "<?php echo number_format({$expression}, 2); ?>";
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
