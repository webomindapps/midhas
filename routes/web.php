<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\LoginController;
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

//cart
Route::get('/cart', [CartController::class, 'cartView'])->name('cart');
Route::post('/add/cart', [CartController::class, 'store'])->name('add-to-cart');
Route::get('add/cart/{id}', [CartController::class, 'storeQty1']);
Route::post('/cart/update', [CartController::class, 'update'])->name('cart-update');
Route::get('cart-item/delete/{id}', [CartController::class, 'destroy'])->name('delete-cart');




//pages
Route::get('page/{page}', [ShopController::class, 'pageDetails'])->name('page.view');




require __DIR__ . '/auth.php';
//product category
Route::any('{any}', [ShopController::class, 'productByCategory'])->name('productByCategory');