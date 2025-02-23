<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Permission;
use App\Models\User;
use App\Models\Privilege;
use Illuminate\Support\Facades\Gate;

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

        // Menambahkan Gate untuk create_post
        Gate::define('create-user', function (User $user) {
            return $user->privilege->permission->contains('id', 1);
        });
    }
}
