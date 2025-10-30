<?php

namespace App\Providers;

use App\Models\Experience;
use App\Models\User;
use Gate;
use Illuminate\Pagination\Paginator;
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
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('rides-create', function (User $user) {
            return Gate::allows('admin') || $user->experiences()->count() >= 3;
        });

        Gate::define('experiences-edit', function (User $user, Experience $experience) {
            return Gate::allows('admin') || $user->id === $experience->user_id;
        });
    }
}
