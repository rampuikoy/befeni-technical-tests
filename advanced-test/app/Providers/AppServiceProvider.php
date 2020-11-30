<?php

namespace App\Providers;

use App\Models\ShirtOrder;
use App\Observers\ShirtOrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\ShirtOrder\ShirtOrderRepository',
            'App\ShirtOrder\EloquentRepository'
        );

        $this->app->bind(
            'App\ShirtOrder\Datasource\DataSourceRepository',
            'App\ShirtOrder\Datasource\EloquentRepository'
        );

        $this->app->bind(
            'App\ShirtOrder\TestResource\TestResourceRepository',
            'App\ShirtOrder\TestResource\EloquentRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ShirtOrder::observe(ShirtOrderObserver::class);
    }
}
