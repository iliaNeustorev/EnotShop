<?php

use App\Http\Controllers\Adress as AdressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Sessions as SessionsController;
use App\Http\Controllers\Cart as CartController;
use App\Http\Controllers\Category as CategoryController;
use App\Http\Controllers\Product as ProductController;
use App\Http\Controllers\Profile as ProfileController;
use App\Http\Controllers\Promo as PromoController;

Route::middleware('auth:sanctum')->get('/get', [ SessionsController::class, 'getUser' ]);

Route::prefix('categories')->group(function() {
    Route::get('/all', [CategoryController::class, 'all']);
    Route::get('/navBar', [CategoryController::class, 'allForNavBar']);
    Route::get('/{slug}/products', [CategoryController::class, 'oneWithProducts']);
});

Route::prefix('products')->group(function() {
    Route::get('/mostSold', [ProductController::class, 'mostSold']);
    Route::get('/{slug}', [ProductController::class, 'one']);
    Route::post('/selected', [ProductController::class, 'loadSelected']);
});

Route::prefix('cart')->group(function() {
    Route::delete('/{id}/delete', [CartController::class, 'remove']);
    Route::get('/all', [CartController::class, 'all']);
    Route::put('/add', [CartController::class, 'add']);
    Route::put('/sync', [CartController::class, 'sync']);
    Route::prefix('promo')->group(function(){
        Route::get('/get', [PromoController::class, 'get']);
        Route::post('/check', [PromoController::class, 'check']);
        // ->middleware('throttle:3,15');
        Route::put('/add', [PromoController::class, 'addToUser']);
        Route::put('/remove', [PromoController::class, 'removeFromUser']);
    });
});

Route::prefix('profile')->group(function() {
    Route::put('/edit', [ProfileController::class, 'edit']);
    Route::get('/discount', [ProfileController::class, 'getDiscount']);
        Route::prefix('adress')->group(function() {
            Route::get('/', [AdressController::class, 'index']);
            Route::post('/', [AdressController::class, 'store']);
            Route::put('/main', [AdressController::class, 'changeMain']);
            Route::delete('/{id}', [AdressController::class, 'destroy']);
        });
});
