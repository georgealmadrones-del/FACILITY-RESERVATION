<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

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
        // Automatically run database migrations on production/Render deployment
        if ($this->app->environment('production')) {
            try {
                Artisan::call('migrate', ['--force' => true]);
            } catch (\Exception $e) {
                // Ignore if DB isn't fully ready yet
            }
        }
    }
}