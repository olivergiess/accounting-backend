<?php

namespace App\Providers;

use App\Http\Rules\Can;
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
    	$this->app->bind('App\Auth\Contracts\Repositories\AuthRepository', \App\Auth\Repositories\PassportAuthRepository::class);
        $this->app->bind('App\Account\Contracts\Repositories\AccountRepository', \App\Account\Repositories\EloquentAccountRepository::class);
		$this->app->bind('App\Ledger\Contracts\Repositories\LedgerRepository', \App\Ledger\Repositories\EloquentLedgerRepository::class);
		$this->app->bind('App\Transaction\Contracts\Repositories\TransactionRepository', \App\Transaction\Repositories\EloquentTransactionRepository::class);
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
