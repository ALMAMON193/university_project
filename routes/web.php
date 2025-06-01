<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__.'/auth.php';

// routes/web.php
Route::get('/verify-otp', [RegisteredUserController::class, 'showOtpForm'])
    ->name('verification.otp');

Route::post('/verify-otp', [RegisteredUserController::class, 'verifyOtp'])
    ->name('email-otp-verification');

Route::post('/resend-otp', [RegisteredUserController::class, 'resendOtp'])
    ->name('verification.resend-otp');
