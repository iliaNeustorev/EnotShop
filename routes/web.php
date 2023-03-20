<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main as MainController;
use App\Http\Controllers\Auth\Sessions as SessionsController;
use App\Http\Controllers\Auth\Register as RegisterController;
use App\Http\Controllers\Auth\NewPassword as NewPasswordController;
use App\Http\Controllers\Auth\Verification as VerificationController;
use App\Http\Controllers\Auth\PasswordReset as PasswordResetController;

Route::controller(SessionsController::class)->group(function() {
    Route::middleware('guest')->group(function() {
        Route::get('auth/login', 'create')->name('login');
        Route::post('auth/login', 'store');
        Route::get('auth/register', [RegisterController::class, 'create'])->name('register');
        Route::post('auth/register', [RegisterController::class, 'store']);
    });
    Route::middleware('auth')->group(function() {
        Route::post('/auth/logout', 'logout');
    });
});

Route::middleware('auth')->group(function() {
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'repeatSendMail'])->middleware('throttle:10,1')->name('verification.send');
});

Route::middleware('guest')->group(function() {
    Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::get('/{any}', [ MainController::class, 'showSpa' ])->where('any', '^(?!api).*$')->name('home');
