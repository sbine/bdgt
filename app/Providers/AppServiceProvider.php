<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;
use Sbine\Tenancy\Tenant;

class AppServiceProvider extends ServiceProvider
{
    use LoadsTranslatedCachedRoutes;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        RateLimiter::for('exports', function () {
            return Limit::perMinute(5);
        });

        $this->app->bindIf(Tenant::class, function () {
            // Throw an AuthenticatedException if no auth user is found
            return new Tenant(Auth::authenticate());
        });

        RouteServiceProvider::loadCachedRoutesUsing(fn() => $this->loadCachedRoutes());
    }
}
