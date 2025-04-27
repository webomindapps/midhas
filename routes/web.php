<?php

use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\PasswordResetController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('home');

//Guest login
Route::get('/customer-login',[LoginController::class,'index'])->name('customer.login');
Route::post('/customer-login',[LoginController::class,'authenticate']);
Route::get('/customer-signup',[LoginController::class,'signup'])->name('customer.sign-up');
Route::post('/customer-signup',[LoginController::class,'store']);

Route::get('customer/email-verify', [LoginController::class, 'verify'])->name('customer.verify');
Route::post('customer/email-verify', [LoginController::class, 'sendVerifyMail']);
Route::get('customer/email-verified', [LoginController::class, 'verifyEmail'])->name('customer.email.verified');

// Route::get('/customer/forgot-password',[PasswordResetController::class,'Forgetpassword'])->name('customer.forget');
// Route::post('/customer/forgot-password',[PasswordResetController::class,'forgetMail']);

Route::get('customer/{token}/password-reset', [PasswordResetController::class, 'resetView'])->name('customer.password.reset');
Route::post('customer/password-reset', [PasswordResetController::class, 'resetPassword'])->name('customer.password.reset');
Route::get('page/{page}', [ShopController::class, 'pageDetails'])->name('page.view');

require __DIR__.'/auth.php';
