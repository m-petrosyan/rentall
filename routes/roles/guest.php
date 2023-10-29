<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RentController;
use Illuminate\Support\Facades\Route;

Route::resource('brand', BrandController::class)->only('index', 'show');
Route::resource('category', CategoryController::class)->only('index', 'show');
Route::resource('product', ProductController::class)->only('index', 'show');
Route::post('rent', [RentController::class, 'store']);


