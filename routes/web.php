<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControl;
use App\Http\Controllers\ProductControl;
use App\Http\Controllers\Base\UnitControl;
use App\Http\Controllers\Dash\DashboardControl;
use App\Http\Controllers\Base\CategoryControl;
use App\Http\Controllers\SalesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::get('/dashboard', [DashboardControl::class, 'index']);
    Route::get('/register', [UserControl::class, 'register']);
    Route::post('/logout', [UserControl::class, 'logout']);
   

    // Route::get('/search', [ProductControl::class, 'search']);
    
    
    Route::resource('/unit', UnitControl::class);
    Route::resource('/users', UserControl::class);
    Route::resource('/products', ProductControl::class)->except('update');
    Route::post('/products/{id}', [ProductControl::class, 'update']);
    Route::resource('/category', CategoryControl::class);
    Route::resource('/order', SalesController::class)->except('show');
    Route::get('/invoice', [SalesController::class, 'show']);
});



Route::get('/', [userControl::class, 'login']);

//login users
Route::post('/users/authenticate', [userControl::class, 'authenticate']);
