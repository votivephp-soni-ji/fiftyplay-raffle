<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('mfa-verify', [AuthController::class, 'mfaVerify'])->name('mfa.verify');
    Route::post('/login-post', [AuthController::class, 'loginPost'])->name('login.post');
    Route::post('/mfa-verify', [AuthController::class, 'verifyOtp'])->name('mfa.verify.post');
    Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');


        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        //Event Manage
        Route::prefix('event')->group(function () {
            Route::get('/list', [EventController::class, 'index'])->name('event.index');
            Route::get('/create', [EventController::class, 'create'])->name('event.create');
            Route::post('/store', [EventController::class, 'store'])->name('event.store');
        });
    });
});
