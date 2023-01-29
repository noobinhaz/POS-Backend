<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControl;
use App\Http\Controllers\ProductControl;
use App\Http\Controllers\Dash\DashboardControl;
use App\Http\Controllers\Base\CategoryControl;
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
    Route::resource('/users', UserControl::class);
    
    Route::get('/dashboard', [DashboardControl::class, 'index']);
    Route::get('/addCat', [CategoryControl::class, 'showForm']);
    
    Route::resource('/products', ProductControl::class);
    Route::resource('/category', CategoryControl::class);
});



Route::get('/', [userControl::class, 'login']);

//login users
Route::post('/users/authenticate', [userControl::class, 'authenticate']);
