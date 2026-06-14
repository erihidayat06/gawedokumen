<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Gate untuk Admin
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk Premium
        Gate::define('isUser', function (User $user) {
            return $user->role === 'user';
        });


        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
