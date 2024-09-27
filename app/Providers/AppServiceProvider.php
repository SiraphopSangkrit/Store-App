<?php

namespace App\Providers;
use Inertia\Inertia;
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
        Inertia::share([
            'auth' => function () {
                return [
                    'user' => auth()->user() ? [
                        'id' => auth()->user()->id,
                        'name' => auth()->user()->name,
                        'roles' => auth()->user()->getRoleNames(), // Get user roles
                        'permissions' => auth()->user()->getAllPermissions()->pluck('name'), // Get user permissions
                    ] : null,
                ];
            },
        ]);
    }
}
