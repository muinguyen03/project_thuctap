<?php

use App\Http\Controllers\Client\OrderController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

Route::fallback(function() {
    return view('404');
});

Route::middleware([CheckLogin::class])->group(function () {
    Route::post('/process',  [OrderController::class,'process'])->name('client.order.process');

    Route::put('/update/tracking/{id}',  [OrderController::class,'updateTracking'])->name('client.order.update.tracking');

    Route::get('/detail/{id}',[OrderController::class,'detail'])->name('client.order.detail');

    Route::get('/status/{id}',[OrderController::class,'status'])->name('client.order.status');
});
