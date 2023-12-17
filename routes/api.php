<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RestaurantOwnerController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\CustomerReservationController;
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

Route::post('/restaurantownerlogin',   [AuthController::class,'RestaurantOwnerlogin'])->name('restaurantowner.login');
Route::post('/customerlogin',   [AuthController::class,'Customerlogin'])->name('customer.login');
Route::post('/restaurantowner',    [RestaurantOwnerController::class,'store'])->name('restaurantowner.store');
Route::post('/customer',    [CustomerController::class,'store'])->name('customer.store');



Route::middleware(['auth:sanctum'])->group(function (){

    Route::post('/logout', [AuthController::class, 'logout']);  

    Route::controller(RestaurantOwnerController::class)->group(function () {
        Route::get('/restaurantowner',                     'index');
        Route::get('/restaurantowner/{id}',                'show');
        Route::put('/restaurantowner/{id}',                'update')->name('restaurantowner.update');
        Route::put('/restaurantowner/email/{id}',          'email')->name('restaurantowner.email');
        Route::put('/restaurantowner/password/{id}',       'password')->name('restaurantowner.password');
        Route::put('/restaurantowner/image/{id}',       'image')->name('restaurantowner.image');
        Route::delete('/restaurantowner/{id}',             'destroy');

    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/restaurantowned/{id}',             'index1');
        Route::get('/restaurant/{id}',          'show');
        Route::put('/restaurant/{id}',        'update');
        Route::delete('/restaurant/{id}',     'destroy');
        Route::post('/restaurant',            'store');
        Route::put('/restaurant/image/{id}',       'image')->name('restaurant.image');
        Route::get('/restaurant/fetchimage/{id}', 'fetchRestaurantImage')->name('restaurant.fetchimage');
          
    });
    
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer',                     'index');
        Route::get('/customer/{id}',                'show');
        Route::put('/customer/{id}',                'update')->name('customer.update');
        Route::put('/customer/email/{id}',          'email')->name('customerr.email');
        Route::put('/customer/password/{id}',       'password')->name('customer.password');
        Route::put('/customer/image/{id}',          'image')->name('customer.image');
        Route::delete('/customer/{id}',             'destroy');

    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/restaurant2',             'index2');
        Route::get('/restaurant/{id}',          'show');
    });    
    
    });
    Route::controller(CustomerReservationController::class)->group(function () {
        Route::get('/customerreservation',                     'index');
        Route::get('/customerreservationn/{id}',                     'indexrestaurant');
        Route::get('/customerreservationnn/{id}',                     'indexcustomer');
        Route::get('/customerreservation/{id}',                'show');
        Route::put('/customerreservation/{id}',                'update');
        Route::post('/customerreservation',                    'store');
        Route::delete('/customerreservation/{id}',             'destroy');
        Route::put('/reservation/status/{id}',       'status')->name('reservation.status');
    
    });
    
});

