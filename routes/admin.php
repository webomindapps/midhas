<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SpecificationController;
use App\Http\Controllers\Admin\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'store'])->name('login');


Route::middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::resources([
        'categories' => CategoryController::class,
        'stores' => StoreController::class,
        'products' => ProductController::class,
    ]);

    Route::group(['prefix' => 'masters', 'as' => 'masters.'], function () {
        Route::resources([
            'brands' => BrandController::class,
            'specifications' => SpecificationController::class,
        ]);
    });
});
Route::post('deleteProductImage', [AjaxController::class, 'deleteImage']);
