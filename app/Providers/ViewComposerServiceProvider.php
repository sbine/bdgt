<?php

namespace Bdgt\Providers;

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
            'Bdgt\Http\Composers\AccountsComposer'
        );

        view()->composer(
            'partials.dropdowns.accounts',
            'Bdgt\Http\Composers\AccountsComposer'
        );

        view()->composer(
            'partials.dropdowns.categories',
            'Bdgt\Http\Composers\CategoriesComposer'
        );

        view()->composer(
            'partials.dropdowns.bills',
            'Bdgt\Http\Composers\BillsComposer'
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
