<?php

use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('page/{page}', [ShopController::class, 'pageDetails'])->name('page.view');

