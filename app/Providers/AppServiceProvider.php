<?php

namespace App\Providers;

use App\Rules\Can;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->bind('App\Components\Auth\Contracts\Repositories\AuthRepository', \App\Components\Auth\Repositories\PassportAuthRepository::class);
        $this->app->bind('App\Components\Account\Contracts\Repositories\AccountRepository', \App\Components\Account\Repositories\EloquentAccountRepository::class);
		$this->app->bind('App\Components\Ledger\Contracts\Repositories\LedgerRepository', \App\Components\Ledger\Repositories\EloquentLedgerRepository::class);
		$this->app->bind('App\Components\Transaction\Contracts\Repositories\TransactionRepository', \App\Components\Transaction\Repositories\EloquentTransactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('can', function ($attribute, $value, $parameters, $validator) {
            $can = new Can($parameters[0], $parameters[1]);

            return $can->passes($attribute, $value);
        });
    }
}
