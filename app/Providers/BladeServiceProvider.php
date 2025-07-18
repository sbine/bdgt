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
        Blade::directive('honeypot', function () {
            return '<div class="form-row hidden" aria-hidden="true">
                     <input type="text" name="name" value="<?php echo old(\'name\') ?>" autocomplete="off" tabindex="-1" />
                </div>';
        });

        Blade::directive('date', function (string $expression) {
            return "<?php echo (new Illuminate\Support\Carbon({$expression}))->format('F j, Y') ?>";
        });

        Blade::directive('money', function (string $expression) {
            return "<?php echo '$ ' . number_format({$expression}, 2); ?>";
        });

        Blade::directive('number', function (string $expression) {
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
