<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Automatically run migrations on production if tables haven't been created yet
        if ($this->app->environment('production')) {
            try {
                if (!Schema::hasTable('migrations')) {
                    Artisan::call('migrate', ['--force' => true]);
                }
            } catch (\Exception $e) {
                // Prevent crashing if the database is temporarily unreachable
            }
        }
    }
}