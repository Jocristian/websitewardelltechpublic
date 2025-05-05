<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('checkRole')
        ->prefix('mytransactions')
        ->group(function () {
            Route::get('/', [OrderController::class, 'customer_mytransactions'])->name('customer_mytransactions');
        });
    }
}
