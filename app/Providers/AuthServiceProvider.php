<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Transport'=>'App\Policies\TransportModelPolicy',
        'App\Models\CarBodyType'=>'App\Policies\CarBodyTypesModelPolicy',
        'App\Models\Country'=>'App\Policies\CountryModelPolicy',
        'App\Models\Owner'=>'App\Policies\OwnerModelPolicy',
        'App\Models\Tenant'=>'App\Policies\TenantModelPolicy',
        'App\Models\Rent'=>'App\Policies\RentModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


    }
}
