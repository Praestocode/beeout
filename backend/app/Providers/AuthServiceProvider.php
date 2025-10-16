<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Ex. 'App\Models\Place' => 'App\Policies\PlacePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /**
         * ===============================
         * LEVEL SYSTEM AUTH
         * ===============================
         * Level of access is hierarchical:
         * - 1° level → admin
         * - 2° level → admin, subadmin
         * - 3° level → admin, subadmin, moderator
         * - 4° level → anyone (user included)
         */

        $roles = [
            'admin'     => 1,
            'subadmin'  => 2,
            'moderator' => 3,
            'user'      => 4,
        ];

        // Verify valid role
        Gate::before(function (User $user, string $ability) use ($roles) {
            if (!array_key_exists($user->role, $roles)) {
                // If role unrecognised, block access
                return false;
            }
        });

        Gate::define('firstLevel', function (User $user) use ($roles) {
            return $roles[$user->role] <= $roles['admin'];
        });

        Gate::define('secondLevel', function (User $user) use ($roles) {
            return $roles[$user->role] <= $roles['subadmin'];
        });

        Gate::define('thirdLevel', function (User $user) use ($roles) {
            return $roles[$user->role] <= $roles['moderator'];
        });

        Gate::define('fourthLevel', function (User $user) use ($roles) {
            return $roles[$user->role] <= $roles['user'];
        });
    }
}
