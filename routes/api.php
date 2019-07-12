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

Route::post('/login', 'AuthController@login');
Route::post('/login/refresh', 'AuthController@refresh');
Route::post('/logout', 'AuthController@logout');

Route::middleware('auth:api')->group(function () {
	Route::get('/accounts', 'AccountController@all')->middleware('can:all,App\Http\Resources\AccountResource');
    Route::post('/accounts', 'AccountController@store')->middleware('can:store,App\Http\Resources\AccountResource');
    Route::get('/accounts/{id}', 'AccountController@show')->middleware('can:view,App\Http\Resources\AccountResource,id');
    Route::put('/accounts/{id}', 'AccountController@update')->middleware('can:update,App\Http\Resources\AccountResource,id');

    Route::post('/ledgers', 'LedgerController@store')->middleware('can:store,App\Http\Resources\LedgerResource');
    Route::get('/ledgers/{id}', 'LedgerController@show')->middleware('can:view,App\Http\Resources\LedgerResource,id');
    Route::put('/ledgers/{id}', 'LedgerController@update')->middleware('can:update,App\Http\Resources\LedgerResource,id');

    Route::post('/transactions', 'TransactionController@store')->middleware('can:store,App\Http\Resources\TransactionResource');
    Route::get('/transactions/{id}', 'TransactionController@show')->middleware('can:view,App\Http\Resources\TransactionResource,id');
    Route::delete('/transactions/{id}', 'TransactionController@delete')->middleware('can:delete,App\Http\Resources\TransactionResource,id');
});
