<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('money', function (string $expression) {
            return "<?php echo '$ ' . number_format({$expression}, 2); ?>";
        });

        Blade::directive('number', function (string $expression) {
            return "<?php echo number_format({$expression}, 2); ?>";
        });

        Blade::directive('date', function (string $expression) {
            return "<?php echo (new Illuminate\Support\Carbon({$expression}))->format('F j, Y') ?>";
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
