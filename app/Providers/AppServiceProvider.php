<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        //
    }
}
