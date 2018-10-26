<?php

namespace App\Providers;

use App\Entities\Client;
use App\Entities\Installment;
use App\Entities\Lending;
use App\Entities\User;
use App\Policies\ClientPolicy;
use App\Policies\InstallmentPolicy;
use App\Policies\LendingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Client::class => ClientPolicy::class,
        Lending::class => LendingPolicy::class,
        Installment::class => InstallmentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
