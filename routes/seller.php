<?php

use App\Http\Controllers\Seller\Products\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerForgetPasswordController;
use App\Http\Controllers\Seller\SellerProfileController;
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
    Route::middleware(['guest:seller'])->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('login', 'create')->name('login');
            Route::post('login', 'store')->name('store-login');
            Route::get('register', 'register')->name('register');
            Route::post('register', 'createSeller')->name('createSeller');
            Route::get('register-success', 'registerSuccess')->name('register-success');
            Route::get('verify-seller/{token}/{email}', 'verify')->name('verify');
        });
        Route::get('forget-seller-password', [SellerForgetPasswordController::class, 'create'])->name('forget-seller-password');
        Route::post('send-password-rest-link', [SellerForgetPasswordController::class, 'sendPasswordRestLink'])->name('send-password-rest-link');
        Route::get('password/reset/{email}/{token}', [SellerForgetPasswordController::class, 'resetPassword'])->name('resetPassword');
        Route::post('password/reset/{token}', [SellerForgetPasswordController::class, 'resetPasswordHandler'])->name('resetPasswordHandler');
    });//end middleware Guest Group
    Route::middleware(['auth:seller'])->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('home','index')->name('home');
            Route::post('logout','destroy')->name('logout');
        });
        Route::controller(SellerProfileController::class)->group(function () {
            Route::get('profile','profileView')->name('profile');
            Route::post('change-profile-seller-picture','changeProfilePicture')->name('changeProfilePicture');
            Route::get('shop-setting','shopSetting')->name('shop-setting');
            Route::post('shop-setup','shopSetup')->name('shop-setup');
        });
        /*============================ Product Routes====================================*/
        Route::prefix('product')->name('product.')->group(function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/all', 'allProducts')->name('all-products');
                Route::get('/add', 'addProduct')->name('add-product');
                Route::get('/get-product-category', 'getProductCategory')->name('get-product-category');
                Route::post('/create', 'createProduct')->name('create-product');
                Route::get('/edit', 'editProduct')->name('edit-product');
                Route::post('/update', 'updateProduct')->name('update-product');
                Route::post('/upload-images', 'uploadProductImages')->name('upload-images');
                Route::get('/get-product-images', 'getProductImages')->name('get-product-images');
                Route::post('/delete-product-image', 'deleteProductImage')->name('delete-product-image');
                Route::post('/delete-product', 'deleteProduct')->name('delete-product');
            });
        });

    });//end middleware seller Group
});

