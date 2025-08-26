<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // OTP
    // Route::post('otp/send', [OtpController::class, 'send']);
    // Route::post('otp/verify', [OtpController::class, 'verify']);

    // Social (token-based from client)
    // Route::post('social/{provider}/token', [SocialAuthController::class, 'loginWithToken'])
    //     ->whereIn('provider', ['google', 'facebook', 'apple']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('me', [ProfileController::class, 'me']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('profile/avatar', [ProfileController::class, 'uploadAvatar']);
});
