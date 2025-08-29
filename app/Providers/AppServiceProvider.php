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
        if (!defined('EVENT_ORGANIZER')) {
            define('EVENT_ORGANIZER', 2);
        }
        if (!defined('FINANCE_MANAGER')) {
            define('FINANCE_MANAGER', 3);
        }
        if (!defined('BUYERS')) {
            define('BUYER', 4);
        }
    }
}
