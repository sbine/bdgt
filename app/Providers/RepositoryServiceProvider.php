<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
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
     */
    public function register()
    {
        $resources = [
            'Account',
            'Bill',
            'Category',
            'Goal',
            'Transaction',
        ];

        foreach ($resources as $resource) {
            $this->app->bind(
                'App\Repositories\Contracts\\' . $resource . 'RepositoryInterface',
                function ($app) use ($resource) {
                    $repositoryPath = 'App\Repositories\Eloquent\Eloquent' . $resource . 'Repository';
                    return $app->make($repositoryPath);
                }
            );
        }
    }
}
