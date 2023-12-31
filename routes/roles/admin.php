<?php


use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\KitController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('auth', [UserController::class, 'auth']);
    Route::resource('user', UserController::class)->only('index', 'show');
    Route::resource('category', CategoryController::class)->only('store', 'update', 'destroy');
    Route::resource('brand', BrandController::class)->only('store', 'update', 'destroy');
    Route::get('product-options', [ProductController::class, 'options'])->name('options');
    Route::resource('product', ProductController::class)->except('index', 'show', 'create');
    Route::get('kit-options', [KitController::class, 'options']);
    Route::resource('kit', KitController::class)->except('create', 'edit');
    Route::resource('rent', RentController::class)->only('index', 'show');
});
