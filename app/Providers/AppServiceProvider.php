<?php

namespace App\Providers;

use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Pagination\Paginator::useBootstrap();
    }
}
