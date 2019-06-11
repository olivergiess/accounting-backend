<?php

namespace App\Providers;

use Carbon\Carbon;
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
        \App\Http\Resources\AccountResource::class => \App\Policies\AccountPolicy::class,
		\App\Http\Resources\LedgerResource::class => \App\Policies\LedgerPolicy::class,
		\App\Http\Resources\TransactionResource::class => \App\Policies\TransactionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
		$this->registerPolicies();

		Passport::routes(function ($router) {
			$router->forAccessTokens();
		});

		Passport::tokensExpireIn(Carbon::now()->addMinutes(10));
		Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
