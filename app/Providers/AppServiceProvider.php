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
    ];
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-patients', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('delete-patient', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('restore-patient', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('view-sensitive-data', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
