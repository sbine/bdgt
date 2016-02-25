<?php

namespace Bdgt\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

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
        $this->app->bind(
            'Bdgt\Repositories\Contracts\AccountRepositoryInterface',
            function ($app, $parameters) {
                $model = reset($parameters);
                if (!$model) {
                    $model = $app->make('Bdgt\Resources\Account');
                }
                $repository = new \Bdgt\Repositories\Eloquent\EloquentAccountRepository($model);
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\BillRepositoryInterface',
            function ($app, $parameters) {
                $model = reset($parameters);
                if (!$model) {
                    $model = $app->make('Bdgt\Resources\Bill');
                }
                $repository = new \Bdgt\Repositories\Eloquent\EloquentBillRepository($model);
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\CategoryRepositoryInterface',
            function ($app, $parameters) {
                $model = reset($parameters);
                if (!$model) {
                    $model = $app->make('Bdgt\Resources\Category');
                }
                $repository = new \Bdgt\Repositories\Eloquent\EloquentCategoryRepository($model);
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\GoalRepositoryInterface',
            function ($app, $parameters) {
                $model = reset($parameters);
                if (!$model) {
                    $model = $app->make('Bdgt\Resources\Goal');
                }
                $repository = new \Bdgt\Repositories\Eloquent\EloquentGoalRepository($model);
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\TransactionRepositoryInterface',
            function ($app, $parameters) {
                $model = reset($parameters);
                if (!$model) {
                    $model = $app->make('Bdgt\Resources\Transaction');
                }
                $repository = new \Bdgt\Repositories\Eloquent\EloquentTransactionRepository($model);
                return $this->scopeForCurrentTenant($repository);
            }
        );
    }

    private function scopeForCurrentTenant($repository)
    {
        if (env('APP_ENV') === 'testing') {
            return $repository->scopeBy('user_id', 'testing');
        }
        return $repository->scopeBy('user_id', Auth::user()->id);
    }
}
