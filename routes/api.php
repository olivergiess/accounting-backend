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
    Route::post('/accounts', 'AccountController@store');
    Route::get('/accounts/{id}', 'AccountController@show');
    Route::put('/accounts/{id}', 'AccountController@update');

    Route::post('/ledgers', 'LedgerController@store');
    Route::get('/ledgers/{id}', 'LedgerController@show');
    Route::put('/ledgers/{id}', 'LedgerController@update');

    Route::post('/transactions', 'TransactionController@store');
    Route::get('/transactions/{id}', 'TransactionController@show');
    Route::delete('/transactions/{id}', 'TransactionController@delete');
});
