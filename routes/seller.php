<?php

use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| seller Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('seller/')->name('seller.')->group(function () {
    Route::middleware([])->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('login', 'create')->name('login');
            Route::post('login', 'store')->name('store-login');
            Route::get('register', 'register')->name('register');
            Route::post('register', 'createSeller')->name('createSeller');
            Route::get('register-success', 'registerSuccess')->name('register-success');
            Route::get('verify-seller/{token}/{email}', 'verify')->name('verify');
        });
    });//end middleware Guest Group
    Route::middleware([])->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('home','index')->name('home');
        });
    });//end middleware seller Group
});

