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
        \App\Account\Http\Resources\AccountResource::class => \App\Account\Policies\AccountPolicy::class,
		\App\Ledger\Http\Resources\LedgerResource::class => \App\Ledger\Policies\LedgerPolicy::class,
		\App\Transaction\Http\Resources\TransactionResource::class => \App\Transaction\Policies\TransactionPolicy::class,
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
