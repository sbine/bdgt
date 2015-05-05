<?php namespace Bdgt\Providers;

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
            function ($app) {
                $repository = new \Bdgt\Repositories\Eloquent\EloquentAccountRepository;
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\BillRepositoryInterface',
            function ($app) {
                $repository = new \Bdgt\Repositories\Eloquent\EloquentBillRepository;
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\CategoryRepositoryInterface',
            function ($app) {
                $repository = new \Bdgt\Repositories\Eloquent\EloquentCategoryRepository;
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\GoalRepositoryInterface',
            function ($app) {
                $repository = new \Bdgt\Repositories\Eloquent\EloquentGoalRepository;
                return $this->scopeForCurrentTenant($repository);
            }
        );

        $this->app->bind(
            'Bdgt\Repositories\Contracts\TransactionRepositoryInterface',
            function ($app) {
                $repository = new \Bdgt\Repositories\Eloquent\EloquentTransactionRepository;
                return $this->scopeForCurrentTenant($repository);
            }
        );
    }

    private function scopeForCurrentTenant($repository)
    {
        return $repository->scopeBy('user_id', Auth::user()->id);
    }
}
