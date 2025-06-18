<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
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
        if (! $this->app->environment('testing')) {
            Schema::defaultStringLength(191);
        }

        RateLimiter::for('exports', function () {
            return Limit::perMinute(5);
        });

        $this->app->singleton(Tenant::class, function () {
            // Throw an AuthenticatedException if no auth user is found
            return new Tenant(Auth::authenticate());
        });

        RouteServiceProvider::loadCachedRoutesUsing(fn() => $this->loadCachedRoutes());
    }
}
