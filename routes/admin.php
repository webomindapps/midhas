<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'store'])->name('login');


Route::middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::resources([
        'categories' => CategoryController::class,
    ]);

    Route::group(['prefix' => 'masters', 'as' => 'masters.'], function () {
        Route::resources([
            'brands' => BrandController::class,
        ]);
    });
    Route::group(['prefix' => 'cms', 'as' => 'cms.'], function () {
        Route::resources([
            'banners' => BannerController::class,
        ]);
        
    });
});
