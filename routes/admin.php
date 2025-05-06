<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SpecificationController;

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'store'])->name('login');


Route::middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::resources([
        'categories' => CategoryController::class,
        'stores' => StoreController::class,
        'products' => ProductController::class,
        'customers' => CustomerController::class,
    ]);

    Route::group(['prefix' => 'masters', 'as' => 'masters.'], function () {
        Route::resources([
            'brands' => BrandController::class,
            'specifications' => SpecificationController::class,
        ]);
    });
    Route::group(['prefix' => 'cms', 'as' => 'cms.'], function () {
        Route::resources([
            'banners' => BannerController::class,
        ]);
        Route::resources([
            'pages' => PageController::class,
        ]);
        Route::resources([
            'sliders' => SliderController::class,
        ]);
    });
});
Route::post('deleteProductImage', [AjaxController::class, 'deleteImage']);
