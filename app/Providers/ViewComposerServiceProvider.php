<?php

namespace App\Providers;

use App\Http\Composers\AccountsComposer;
use App\Http\Composers\BillsComposer;
use App\Http\Composers\CategoriesComposer;
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
        view()->composer('partials.dropdowns.accounts', AccountsComposer::class);

        view()->composer('partials.dropdowns.categories', CategoriesComposer::class);

        view()->composer('partials.dropdowns.bills', BillsComposer::class);
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
