<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('owner', function(User $user){
            if($user->role === 'owner'){
                return true;
            };
            return false;
        });
        Gate::define('admins', function(User $user){
            if($user->role === 'owner' || $user->role === 'admin'){
                return true;
            };
            return false;
        });
        Gate::define('bloger', function(User $user){
            if($user->role === 'owner' || $user->role === 'admin' || $user->role === 'bloger'){
                return true;
            };
            return false;
        });
    }
}
