<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('role.manager', function ($app) {
            return new \App\Services\RoleManager();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Additional Blade directives for role management
        Blade::if('hasRole', function ($role) {
            return auth()->check() && auth()->user()->hasDepartment($role);
        });

        Blade::if('isAdmin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        Blade::if('canView', function ($feature) {
            if (!auth()->check()) return false;

            $user = auth()->user();
            $permissions = [
                'dashboard' => $user->canAccessDashboard(),
                'sptt' => $user->canAccessSPTT(),
                'pcr-apr' => $user->canAccessPCRAPR(),
                'draft' => true, // All users can access draft
                'final' => true, // All users can access final
            ];

            return $permissions[$feature] ?? false;
        });
    }
}
