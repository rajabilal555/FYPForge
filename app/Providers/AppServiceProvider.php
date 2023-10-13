<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
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
        Auth::macro('currentGuard', function (): Guard|StatefulGuard|null {
            $guards = array_keys(config('auth.guards'));
            foreach ($guards as $guard) {
                if (auth()->guard($guard)->check()) {
                    return auth()->guard($guard);
                }
            }
            return null;
        });
    }
}
