<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SetProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SubShippingController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\PermissionsController;
Route::fallback(function () {
    // Handle the error here
    abort(404, 'Page Not Found');
});

Route::middleware('admin')->group(function (){
    Route::get('', DashboardController::class)->name('dashboard');
    Route::resource('product'       ,ProductController::class)->except('show');
    Route::resource('category'      ,CategoryController::class)->except('show');
    Route::resource('sub_category'  ,SubCategoryController::class)->except('show');
    Route::resource('set_product'   ,SetProductController::class)->except('show', 'create', 'store');
    Route::resource('shipping'      ,ShippingController::class)->except('show');
    Route::resource('sub_shipping'  ,SubShippingController::class)->except('show');
    Route::resource('contact'       ,ContactController::class)->except('show','store','create','edit','update');
    Route::resource('user'          ,UserController::class)->except('create','store');
    Route::resource('permission'    ,PermissionsController::class)->except('show','store','create');
    Route::get('/product/sub_category',[ProductController::class, 'sub_category'])->name('backend.product.sub_category');
    Route::get('/product/set_product' ,[ProductController::class, 'set_product'])->name('backend.product.set_product');

});




Route::group(['middleware'=>'admin.guest'],function (){
    Route::get( '/login'            ,[UserController::class, 'loginView'])->middleware('admin.guest')->name('user.login');
    Route::post('/login'            ,[UserController::class, 'login']);
    Route::get( '/register'         ,[UserController::class, 'register'])->name('user.register');
    Route::resource('user', UserController::class)->only('store');
    Route::get('/forgot_password'   ,[UserController::class,'forgot_password_view'])->name('user.forgot');
    Route::post('/forgot_password'  ,[UserController::class,'forgot_password'])->name('forgot');
    Route::get('/otp_code'          ,[UserController::class,'otp_view'])->name('user.otp_code');

    Route::post('otp-code/check'    ,[UserController::class,'otp_check'])->name('backend.user.otp_check');
    Route::get('/recover_password'  ,[UserController::class,'recover_password_view'])->name('user.recover_password');
    Route::post('/recover_password' ,[UserController::class,'recover_password'])->name('recover_password');
});

Route::get( '/login'            ,[UserController::class, 'loginView'])->middleware('admin.guest')->name('user.login');
Route::post('/login'            ,[UserController::class, 'login']);
Route::get( '/register'         ,[UserController::class, 'register'])->name('user.register');
Route::post('/logout'           ,[UserController::class, 'logout'])->name('user.logout');
Route::get( '/change-password'  ,[UserController::class, 'change_password_view'])->name('user.change_password');
Route::post('/change-password'  ,[UserController::class, 'change_password']);
Route::get( '/profile-edit/{id}',[UserController::class, 'profile_edit_view'])->name('user.profile_edit');
Route::put( '/profile-edit/{id}',[UserController::class, 'profile_edit'])->name('user.profile_update');


?>
