<?php

Route::get('/accounts', 'App\Components\Account\Http\Controllers\AccountController@all')->middleware('can:all,App\Components\Account\Http\Resources\AccountResource');
Route::post('/accounts', 'App\Components\Account\Http\Controllers\AccountController@store')->middleware('can:store,App\Components\Account\Http\Resources\AccountResource');
Route::get('/accounts/{id}', 'App\Components\Account\Http\Controllers\AccountController@show')->middleware('can:view,App\Components\Account\Http\Resources\AccountResource,id');
Route::put('/accounts/{id}', 'App\Components\Account\Http\Controllers\AccountController@update')->middleware('can:update,App\Components\Account\Http\Resources\AccountResource,id');

Route::post('/ledgers', 'App\Components\Ledger\Http\Controllers\LedgerController@store')->middleware('can:store,App\Components\Ledger\Http\Resources\LedgerResource');
Route::get('/ledgers/{id}', 'App\Components\Ledger\Http\Controllers\LedgerController@show')->middleware('can:view,App\Components\Ledger\Http\Resources\LedgerResource,id');
Route::put('/ledgers/{id}', 'App\Components\Ledger\Http\Controllers\LedgerController@update')->middleware('can:update,App\Components\Ledger\Http\Resources\LedgerResource,id');

Route::post('/transactions', 'App\Components\Transaction\Http\Controllers\TransactionController@store')->middleware('can:store,App\Components\Transaction\Http\Resources\TransactionResource');
Route::get('/transactions/{id}', 'App\Components\Transaction\Http\Controllers\TransactionController@show')->middleware('can:view,App\Components\Transaction\Http\Resources\TransactionResource,id');
Route::delete('/transactions/{id}', 'App\Components\Transaction\Http\Controllers\TransactionController@delete')->middleware('can:delete,App\Components\Transaction\Http\Resources\TransactionResource,id');
