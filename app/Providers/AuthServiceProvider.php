<?php

namespace App\Providers;

use App\Models\UserTenant;
use App\User;
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

        //Criando Habilidades
        Gate::define('isAdmin', function (User $user){
           return $user->tipo_user == 'A';
        });

        Gate::define('isProfessor', function (User $user){
           return ($user->tipo_user == 'P' || $user->tipo_user == 'A');
        });

        Gate::define('isRecep', function (User $user){
            return ($user->tipo_user == 'R' || $user->tipo_user == 'A');
        });

    }
}
