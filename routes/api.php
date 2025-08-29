<?php

use App\Http\Controllers\api\FirebaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\ProfileController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::post('firebase-login', [FirebaseAuthController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('me', [ProfileController::class, 'me']);
    Route::post('/register-device-token', [ProfileController::class, 'registerDevice']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('profile/avatar', [ProfileController::class, 'uploadAvatar']);

    Route::prefix('event')->group(function () {
        Route::post("/create", [EventController::class, 'create']);
        Route::post('/{event}/pause', [EventController::class, 'pause']);
        Route::post('/{event}/resume', [EventController::class, 'resume']);
    });
});
