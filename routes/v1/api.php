<?php

use App\Http\Controllers\UserControl;
use App\Http\Controllers\ProductControl;

Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('/users', UserControl::class);
    Route::resource('/products', ProductControl::class);
});

Route::post('/user/authenticate', [UserControl::class, 'authenticate']); //login