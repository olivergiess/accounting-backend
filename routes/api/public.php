<?php

Route::post('/login', 'App\Components\Auth\Http\Controllers\AuthController@login');
Route::post('/login/refresh', 'App\Components\Auth\Http\Controllers\AuthController@refresh');
Route::post('/logout', 'App\Components\Auth\Http\Controllers\AuthController@logout');
