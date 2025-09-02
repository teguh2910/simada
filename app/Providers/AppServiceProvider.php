<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom Blade directives for role-based access
        \Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        \Blade::if('hasDepartment', function ($department) {
            return auth()->check() && auth()->user()->hasDepartment($department);
        });

        \Blade::if('canAccess', function ($permission) {
            return auth()->check() && \Gate::allows($permission);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
