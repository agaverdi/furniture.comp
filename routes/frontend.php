<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishesController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;

Route::get('', IndexController::class)->name('index');
Route::get('/get-comments',[ProductController::class, 'getComments'])->name('product.get_comment');
Route::get('/product/comment',[ProductController::class, 'product_comment'])->name('frontend.product.comment');

Route::post('/product/range', [ProductController::class,'product_range'])->name('frontend.product.range');
Route::post('/all_product/range', [ProductController::class,'all_product_range'])->name('frontend.all_product.range');
Route::post('/product/icon-change',[WishesController::class,'icon_change'])->name('frontend.product.icon_change');
Route::post('/product/card-list-add',[WishesController::class, 'card_list_add'])->name('frontend.product.card_list_add');
Route::post('/product/close-wish',[WishesController::class,'close_wish'])->name('frontend.product_wish');
Route::post('/product/wish-list-append',[WishesController::class,'wish_list_append'])->name('frontend.wish_list_append');
Route::post('/product/wish-list-refresh',[WishesController::class,'wish_list_refresh'])->name('frontend.wish_list_refresh');
Route::post('/product/wish-list-clear',[WishesController::class,'wish_list_clear'])->name('frontend.wish_list_clear');
Route::post('/product/cart-add-wishes-all',[WishesController::class,'cart_add_wishes_all'])->name('frontend.cart_add_wishes_all');
Route::post('/product/cart-add-wishes-all-copy',[WishesController::class,'cart_add_wishes_all_copy'])->name('frontend.cart_add_wishes_all_copy');

Route::post('/product/wish-add-and-delete-single-list',[WishesController::class,'wish_add_and_delete_single_list'])->name('frontend.wish_add_and_delete_single_list');
Route::post('/product/wish-delete-single-list',[WishesController::class,'wishes_delete_single'])->name('frontend.wishes_add_single');
Route::post('/product/wish-iks',[WishesController::class,'wish_iks'])->name('frontend.wish_iks');
Route::post('/product/card-iks',[WishesController::class,'card_iks'])->name('frontend.card_iks');
Route::post('/product/card-iks-checkout',[WishesController::class,'card_iks_checkout'])->name('frontend.card_iks_checkout');
Route::post('/product/card-product-delete',[WishesController::class,'card_product_delete'])->name('frontend.card_product_delete');
Route::post('/product/shipping',[CheckoutController::class,'product_shipping'])->name('frontend.product_shipping');
Route::post('/product/sub_shipping',[CheckoutController::class,'product_sub_shipping'])->name('frontend.product_sub_shipping');
Route::post('/product/shipping-price',[CheckoutController::class,'product_shipping_price'])->name('frontend.product_shipping_price');
Route::post('/product/cart-subtotal-price',[CheckoutController::class,'cart_subtotal_price'])->name('frontend.cart_subtotal_price');


Route::group(['middleware'=>'guest'],function (){
    Route::get('/registration',[UserController::class,'index'])->name('register');
    Route::post('/registration',[UserController::class,'store'])->name('user.store');
    Route::get('/login',[UserController::class,'loginView'])->name('login');
    Route::post('/login',[UserController::class,'login'])->name('user.login');
});


Route::group(['middleware'=>'auth'],function (){
    Route::get('/wish-list'         ,[WishesController::class,'wish_list'])->name('user.wish');
    Route::get('/order-checkout-list',[CheckoutController::class, 'checkout_list'])->name('user.checkout_list');
    Route::get('/change-password'   ,[UserController::class,'changePasswordView'])->name('user.change_password_view');
    Route::post('/change-password'   ,[UserController::class,'changePassword'])->name('user.changePassword');
    Route::get('/order-shopping-cart',[CheckoutController::class,'shopping_cart'])->name('user.cart');
    Route::get('/order-tracking'    ,[CheckoutController::class,'tracking'])->name('user.tracking');
    Route::get('/cart-to-checkout'  ,[CheckoutController::class, 'cart_to_checkoutView'])->name('user.cart_to_checkout');
    Route::post('/cart-to-checkout' ,[CheckoutController::class,'cart_to_checkout']);
    Route::post('/checkout'         ,[CheckoutController::class,'checkout'])->name('checkout');
    Route::post('/checkout-delete'  ,[CheckoutController::class,'checkout_delete'])->name('user.checkout_delete');;
    Route::get('/account'           ,[UserController::class,'accountView'])->name('account');
    Route::post('/account'          ,[UserController::class,'account'])->name('user.account');
    Route::post('/logout'           ,[UserController::class,'logout'])->name('logout');
});

Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::post('/contact',[ContactController::class,'store'])->name('contact.send');
Route::post('/product/sort',[ProductController::class,'sort'])->name('product.sort');
Route::post('/product/all_sort',[ProductController::class,'all_sort'])->name('product.all_sort');

Route::get('/about',[AboutController::class,'index'])->name('about');

Route::match(['get', 'post'], '/search', [IndexController::class, 'searchView'])->name('search');

Route::get('{level1}/{level2?}/{level3?}',[ProductController::class, 'show'])->name('product.index');





