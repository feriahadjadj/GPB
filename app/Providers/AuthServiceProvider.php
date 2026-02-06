<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();


      Gate::define('manage-users',function($user){
            return $user->hasAnyRoles(['superA','admin']);
        });


      Gate::define('edit-users',function($user){

            return $user->hasRole('superA');
        });

        Gate::define('edit-projet',function($user){

            return $user->hasAnyRoles(['superA','user','Dipb']);
        });

        Gate::define('delete-users',function($user){
            return $user->hasRole('superA');
        });

        Gate::define('upw-role',function($user){
            return $user->hasAnyRoles(['user','Dipb']);
        });
        Gate::define('show-statistics',function($user){
            return $user->hasAnyRoles(['admin']);
        });

        Gate::define('info',function($user){
           return $user->isUser('djemmal@namane.dz');

        });

        //
    }
}
