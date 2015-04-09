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
            'Bdgt\Repositories\Contracts\BillRepositoryInterface',
            function($app) {
            	$repository = new \Bdgt\Repositories\Eloquent\EloquentBillRepository;
            	return $repository->scopeBy('user_id', Auth::user()->id);
            }
        );
    }
}
