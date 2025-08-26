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

        Route::get('create-event', [EventController::class, 'create'])->name('create.event');
    });
});
