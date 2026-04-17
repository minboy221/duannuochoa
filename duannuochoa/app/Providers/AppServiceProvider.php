<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('layouts.app', function ($view) {
            if (auth()->check()) {
                $unnotified = \App\Models\Order::where('user_id', auth()->id())
                    ->where('status', 'Đã hủy')
                    ->where('client_notified', false)
                    ->get();
                $view->with('unnotifiedCancelledOrders', $unnotified);
            }
        });
    }
}
