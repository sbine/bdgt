<?php

namespace Bdgt\Providers;

use Bdgt\Tenancy\Tenant;
use DomainException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class TenancyProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     * @throws DomainException
     */
    public function register()
    {
        $this->app->singleton(Tenant::class, function() {
            if (! Auth::check()) {
                throw new DomainException('Unable to apply tenancy: no authenticated user found');
            }
            return new Tenant(Auth::user());
        });
    }

    public function provides(): array
    {
        return [
            Tenant::class
        ];
    }
}
