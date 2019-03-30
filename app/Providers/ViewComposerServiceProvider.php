<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'partials.sidebar',
            'App\Http\Composers\AccountsComposer'
        );

        view()->composer(
            'partials.dropdowns.accounts',
            'App\Http\Composers\AccountsComposer'
        );

        view()->composer(
            'partials.dropdowns.categories',
            'App\Http\Composers\CategoriesComposer'
        );

        view()->composer(
            'partials.dropdowns.bills',
            'App\Http\Composers\BillsComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
