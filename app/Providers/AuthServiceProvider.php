<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Carbon\Carbon;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Components\Account\Http\Resources\AccountResource::class => \App\Components\Account\Policies\AccountPolicy::class,
		\App\Components\Ledger\Http\Resources\LedgerResource::class => \App\Components\Ledger\Policies\LedgerPolicy::class,
		\App\Components\Transaction\Http\Resources\TransactionResource::class => \App\Components\Transaction\Policies\TransactionPolicy::class,
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
