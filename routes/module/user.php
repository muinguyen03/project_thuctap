<?php

use App\Http\Controllers\Client\UserController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

Route::fallback(function() {
    return view('404');
});

Route::middleware([CheckLogin::class])->group(function () {
    Route::prefix('update')->group(function () {
        Route::post('/image',       [UserController::class, 'update_image'])->name('user.update.image');
        Route::post('/information', [UserController::class, 'update_info'])->name('user.update.info');
        Route::post('/password',    [UserController::class, 'update_password'])->name('user.update.password');
    });
});
