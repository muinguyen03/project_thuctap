<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogged;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

Route::fallback(function() {
    return view('404');
});

Route::middleware([CheckLogged::class])->group(function () {
    Route::get('/login',             [AuthController::class,'login'])->name('auth.login');
    Route::get('/register',          [AuthController::class,'register'])->name('auth.register');
    Route::post('/login',            [AuthController::class,'process_login'])->name('auth.login.process');
    Route::post('/register',         [AuthController::class,'process_register'])->name('auth.register.process');
    Route::get('/login_gg',          [AuthController::class,'login_gg'])->name('auth.login_gg');
    Route::get('/google/callback',   [AuthController::class,'callback'])->name('auth.login_gg.callback');
    Route::get('/forgot_password',   [AuthController::class,'forgot'])->name('auth.forgot');
    Route::post('/forgot_password',  [AuthController::class,'sendMail'])->name('auth.forgot.process');
    Route::get('/reset/{token}',     [AuthController::class,'reset_pass'])->name('auth.reset');
    Route::post('/reset',            [AuthController::class,'reset'])->name('auth.reset.process');
});

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
