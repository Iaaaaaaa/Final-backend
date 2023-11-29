<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\RestaurantController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Public APIs

Route::post('/adminlogin',   [AuthController::class,'Adminlogin'])->name('admin.login');
Route::post('/customerlogin',   [AuthController::class,'Customerlogin'])->name('customer.login');
Route::post('/admin',    [AdminController::class,'store'])->name('admin.store');
Route::post('/customer',    [CustomerController::class,'store'])->name('customer.store');



Route::middleware(['auth:sanctum'])->group(function (){

    Route::post('/logout', [AuthController::class, 'logout']);  

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin',                     'index');
        Route::get('/admin/{id}',                'show');
        Route::put('/admin/{id}',                'update')->name('admin.update');
        Route::put('/admin/email/{id}',          'email')->name('admin.email');
        Route::put('/admin/password/{id}',       'password')->name('admin.password');
        Route::put('/admin/image/{id}',       'image')->name('admin.image');
        Route::delete('/admin/{id}',             'destroy');

    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/prompt',             'index');
        Route::get('/prompt/{id}',        'show');
        Route::put('/prompt/{id}',        'update');
        Route::delete('/prompt/{id}',     'destroy');
        Route::post('/restaurant',            'store');
          
    });
    
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer',                     'index');
        Route::get('/customer/{id}',                'show');
        Route::put('/customer/{id}',                'update')->name('customer.update');
        Route::put('/customer/email/{id}',          'email')->name('customerr.email');
        Route::put('/customer/password/{id}',       'password')->name('customer.password');
        Route::put('/customer/image/{id}',       'image')->name('customer.image');
        Route::delete('/customer/{id}',             'destroy');
    
    });
 
});

