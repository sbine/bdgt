<?php

namespace Bdgt\Providers;

use Auth;
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
                'Bdgt\Repositories\Contracts\\' . $resource . 'RepositoryInterface',
                function ($app, $parameters) use ($resource) {
                    $model = reset($parameters);
                    if (!$model) {
                        $model = $app->make('Bdgt\Resources\\' . $resource);
                    }
                    $repositoryPath = '\Bdgt\Repositories\Eloquent\Eloquent' . $resource . 'Repository';
                    $repository = new $repositoryPath($model);
                    return $this->scopeForCurrentTenant($repository);
                }
            );
        }
    }

    private function scopeForCurrentTenant($repository)
    {
        if (env('APP_ENV') === 'testing') {
            return $repository->scopeBy('user_id', 'testing');
        }
        if (!Auth::check()) {
            return $repository->scopeBy('user_id', 'access_denied');
        }
        return $repository->scopeBy('user_id', Auth::user()->id);
    }
}
