<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/inquiry', [HomeController::class, 'inquiry'])->name('inquiry');
Route::get('/page/{slug}', [HomeController::class, 'pageDetail'])->name('page.show');

Route::group(['middleware' => 'isCustomer'], function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/view-order/checkout', [CheckoutController::class, 'OrderItems'])->name('order.view');

    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/confirmation/{order_number}', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

    // profile pages
    Route::get('user/dashboard', [UserController::class, 'myDashboard'])->name('mydashboard');
    Route::get('user/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('user/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('user/orders', [UserController::class, 'myOrders'])->name('myorder');
    Route::get('/order-details/{order}', [UserController::class, 'orderDetails'])->name('order.details');
    Route::get('user/billing', [UserController::class, 'billingDetails'])->name('billing.details');
    Route::post('user/billing/update', [UserController::class, 'billingDetailsUpdate'])->name('billing.details.update');

    Route::post('review', [UserController::class, 'reviewStore'])->name('review');

    Route::post('applycoupon', [CartController::class, 'applyCoupon'])->name('coupon');
});

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category/{slug}', [ProductController::class, 'categoryWise'])->name('product.category');
Route::get('/autocomplete-search', [HomeController::class, 'autocompleteSearch'])->name('autocomplete.search');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/check', [AuthController::class, 'loginCheck'])->name('login.check');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/store', [AuthController::class, 'storeRegister'])->name('register.store');

//login with facebook
Route::get('/login/facebook', [AuthController::class, 'redirectToProvider'])->name('login.facebook');
Route::get('login/facebook/callback', [AuthController::class, 'handleProviderCallback']);

//login with facebook
Route::get('/login/google', [AuthController::class, 'redirectToProviderGoogle'])->name('login.google');
Route::get('login/google/callback', [AuthController::class, 'handleProviderCallbackGoogle']);

// cart
Route::resource('cart', CartController::class);
Route::get('/view-items/cart', [CartController::class, 'cartItems'])->name('cartItems.view');
Route::get('/view-items/cart/increase/{id}', [CartController::class, 'cartItemsIncrease'])->name('cartItems.view.increase');
Route::get('/view-items/cart/decrease/{id}', [CartController::class, 'cartItemsDecrease'])->name('cartItems.view.decrease');
Route::get('/view-items/cart/remove/{id}', [CartController::class, 'cartItemsRemove'])->name('cartItems.view.remove');
Route::post('clearcart', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('/carttotalquantity', [CartController::class, 'cartTotalQuantity'])->name('carttotalquantity');


//forget password
Route::get('forgotpassword', [AuthController::class, 'forgotPassword'])->name('forgotpassword');
Route::post('resetpassword', [AuthController::class, 'sendResetLink'])->name('resetlink');
Route::get('resetpwd/{token}', [AuthController::class, 'resetPasswordForm'])->name('resetpwdform');
Route::post('updateresetpwd', [AuthController::class, 'updateResetpassword'])->name('updateresetpassword');

//for esewa payment
Route::get('esewasuccess', [CheckoutController::class, 'esewaSuccess'])->name('esewasuccess');
Route::get('esewafailure', [CheckoutController::class, 'esewaFailure'])->name('esewafailure');
