<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define gates for role-based access
        Gate::define('access-admin-features', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('access-dashboard', function ($user) {
            return $user->canAccessDashboard();
        });

        Gate::define('access-sptt', function ($user) {
            return $user->canAccessSPTT();
        });

        Gate::define('access-pcr-apr', function ($user) {
            return $user->canAccessPCRAPR();
        });

        Gate::define('access-draft', function ($user) {
            return true; // All authenticated users can access draft
        });

        Gate::define('access-final', function ($user) {
            return true; // All authenticated users can access final
        });
    }
}
