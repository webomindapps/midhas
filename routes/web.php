<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\EnquiryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\PasswordResetController;

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::post('serarch-products', [ShopController::class, 'searchProduct'])->name('search.products');

//Guest login
Route::get('/customer-login', [LoginController::class, 'index'])->name('customer.login');
Route::post('/customer-login', [LoginController::class, 'authenticate']);
Route::get('/customer-signup', [LoginController::class, 'signup'])->name('customer.sign-up');
Route::post('/customer-signup', [LoginController::class, 'store']);

Route::get('customer/email-verify', [LoginController::class, 'verify'])->name('customer.verify');
Route::post('customer/email-verify', [LoginController::class, 'sendVerifyMail']);
Route::get('customer/email-verified', [LoginController::class, 'verifyEmail'])->name('customer.email.verified');

//logout
Route::get('/customer-logout', [LoginController::class, 'logout'])->name('customer.logout');

//cart
Route::get('/cart', [CartController::class, 'cartView'])->name('cart');
Route::post('/add/cart', [CartController::class, 'store'])->name('add-to-cart');
Route::get('add/cart/{id}', [CartController::class, 'storeQty1']);
Route::post('/cart/update', [CartController::class, 'update'])->name('cart-update');
Route::get('cart-item/delete/{id}', [CartController::class, 'destroy'])->name('delete-cart');
Route::get('/minicart-items', [CartController::class, 'minicartItems'])->name('minicart.items');

//checkout
Route::group(['prefix' => 'checkout', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/status/{order}', [CheckoutController::class, 'status'])->name('checkout.status');
});

//wishlist
Route::group(['prefix' => 'wishlists'], function () {
    Route::get('/', [WishListController::class, 'index'])->name('wishlist.index');
    Route::post('add', [WishListController::class, 'store']);
    Route::get('/{id}/delete', [WishListController::class, 'destroy'])->name('wishlist.destroy');
});

//my_profiles
Route::group(['prefix' => 'my-profiles'], function () {
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('order.show');
});

//pages
Route::get('page/{page}', [ShopController::class, 'pageDetails'])->name('page.view');

//deal enquiries
Route::post('enquiry/{product}', EnquiryController::class)->name('product.enquiry');



require __DIR__ . '/auth.php';
//product category
Route::any('{any}', [ShopController::class, 'productByCategory'])->name('productByCategory');
