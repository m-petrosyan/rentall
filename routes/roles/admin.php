<?php


use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\KitController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductSimilarController;
use App\Http\Controllers\Api\RentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('auth', [UserController::class, 'auth']);
    Route::resource('user', UserController::class)->only('index', 'show');
    Route::resource('category', CategoryController::class)->except('create', 'edit');
    Route::resource('brand', BrandController::class)->except('create', 'edit');
    Route::resource('product', ProductController::class)->except('index', 'show', 'create', 'edit');
    Route::prefix('product/{product}')->group(function () {
        Route::post('similar', [ProductSimilarController::class, 'store']);
        Route::put('similar', [ProductSimilarController::class, 'update']);
    });
    Route::resource('kit', KitController::class)->except('create', 'edit');
    Route::resource('rent', RentController::class)->only('index', 'store', 'show');
});
