<?php


use App\Http\Controllers\Api\KitController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('auth', [UserController::class, 'auth']);
    Route::resource('user', UserController::class)->only('index', 'show');
    Route::resource('kit', KitController::class)->only('index', 'show');
    Route::resource('rent', RentController::class)->only('index', 'show');
    Route::resource('product', ProductController::class)->only('store', 'destroy');
});
