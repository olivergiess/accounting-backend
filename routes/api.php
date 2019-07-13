<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'App\Auth\Http\Controllers\AuthController@login');
Route::post('/login/refresh', 'App\Auth\Http\Controllers\AuthController@refresh');
Route::post('/logout', 'App\Auth\Http\Controllers\AuthController@logout');

Route::middleware('auth:api')->group(function () {
	Route::get('/accounts', 'App\Account\Http\Controllers\AccountController@all')->middleware('can:all,App\Account\Http\Resources\AccountResource');
    Route::post('/accounts', 'App\Account\Http\Controllers\AccountController@store')->middleware('can:store,App\Account\Http\Resources\AccountResource');
    Route::get('/accounts/{id}', 'App\Account\Http\Controllers\AccountController@show')->middleware('can:view,App\Account\Http\Resources\AccountResource,id');
    Route::put('/accounts/{id}', 'App\Account\Http\Controllers\AccountController@update')->middleware('can:update,App\Account\Http\Resources\AccountResource,id');

    Route::post('/ledgers', 'App\Ledger\Http\Controllers\LedgerController@store')->middleware('can:store,App\Ledger\Http\Resources\LedgerResource');
    Route::get('/ledgers/{id}', 'App\Ledger\Http\Controllers\LedgerController@show')->middleware('can:view,App\Ledger\Http\Resources\LedgerResource,id');
    Route::put('/ledgers/{id}', 'App\Ledger\Http\Controllers\LedgerController@update')->middleware('can:update,App\Ledger\Http\Resources\LedgerResource,id');

    Route::post('/transactions', 'App\Transaction\Http\Controllers\TransactionController@store')->middleware('can:store,App\Transaction\Http\Resources\TransactionResource');
    Route::get('/transactions/{id}', 'App\Transaction\Http\Controllers\TransactionController@show')->middleware('can:view,App\Transaction\Http\Resources\TransactionResource,id');
    Route::delete('/transactions/{id}', 'App\Transaction\Http\Controllers\TransactionController@delete')->middleware('can:delete,App\Transaction\Http\Resources\TransactionResource,id');
});
