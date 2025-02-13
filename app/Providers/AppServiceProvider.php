<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Define model policies here if needed
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-patients', function (User $user) {
            return $user->role === 'admin'; // Only admin can view patients
        });

        Gate::define('delete-patient', function (User $user) {
            return $user->role === 'admin'; // Only admin can delete
        });

        Gate::define('restore-patient', function (User $user) {
            return $user->role === 'admin'; // Only admin can restore
        });

        Gate::define('view-sensitive-data', function (User $user) {
            return $user->role === 'admin'; // Only admin can view emails
        });
    }
}
