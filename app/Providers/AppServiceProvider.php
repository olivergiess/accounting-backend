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
    	$this->app->bind('App\Contracts\Repositories\AuthRepository', \App\Repositories\PassportAuthRepository::class);
        $this->app->bind('App\Contracts\Repositories\AccountRepository', \App\Repositories\EloquentAccountRepository::class);
		$this->app->bind('App\Contracts\Repositories\LedgerRepository', \App\Repositories\EloquentLedgerRepository::class);
		$this->app->bind('App\Contracts\Repositories\TransactionRepository', \App\Repositories\EloquentTransactionRepository::class);
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
