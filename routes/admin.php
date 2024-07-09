<?php


use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Auth\AdminForgetPasswordController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Categories\CategoryController;
use App\Http\Controllers\Admin\Categories\SubCategoryController;
use App\Http\Controllers\Admin\Profile\AdminProfileController;
use App\Http\Controllers\Admin\Settings\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('admin/')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('login', [AdminAuthController::class, 'create']);
        Route::post('login',[AdminAuthController::class,'store'])->name('login');
        Route::get( 'forget-admin-password',[AdminForgetPasswordController::class,'create'])->name('forget-admin-password');
        Route::post( 'send-password-rest-link',[AdminForgetPasswordController::class,'sendPasswordRestLink'])->name('send-password-rest-link');
        Route::get( 'password/reset/{token}',[AdminForgetPasswordController::class,'resetPassword'])->name('resetPassword');
        Route::post( 'password/reset/{token}',[AdminForgetPasswordController::class,'resetPasswordHandler'])->name('resetPasswordHandler');
    });
    Route::middleware(['auth:admin'])->group(function(){
        Route::controller(AdminAuthController::class)->group(function () {
            Route::get('home', 'index')->name('home');
            Route::post('logout', 'destroy')->name('logout');
        });
        Route::controller(SettingController::class)->group(function () {
            Route::get('settings', 'index')->name('settings');
        });
        Route::get('profile', [AdminProfileController::class,'profileView'])->name('profile');
        Route::post('/change-profile-picture', [AdminProfileController::class, 'changeProfilePicture'])->name('change-profile-picture');
        /*===========================  Categories And Sub categories        =====================================*/
        Route::resource('categories', CategoryController::class);
        /*===========================  Sub-Categories And Sub categories        =====================================*/
        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('sub-categories', 'addSubCategories')->name('add-sub-categories');
            Route::post('store-sub-categories', 'storeSubCategory')->name('storeSubCategory');
            Route::get('sub-category/{id}/edit', 'editSubCategories')->name('edit-sub-categories');
            Route::put('update-sub-category/{id}', 'updateSubCategory')->name('updateSubCategory');
        });

    });
});
