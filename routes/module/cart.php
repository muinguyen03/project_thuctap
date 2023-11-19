<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

Route::fallback(function() {
    return view('404');
});

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/list',                [CartController::class, 'index']);
    Route::post('/add',                [CartController::class, 'store']);
    Route::put('/update/{id}',         [CartController::class, 'update']);
    Route::delete('/delete-item/{id}', [CartController::class, 'remove']);
    Route::delete('/clear',            [CartController::class, 'destroy']);
});
