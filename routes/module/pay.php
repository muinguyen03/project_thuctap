<?php

use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Pay\VnpayController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

Route::fallback(function() {
    return view('404');
});

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/vnpay/{order_code}/{amount}',  [VnpayController::class,'process'])->name('pay.vnpay.process');
    Route::get('/status/vnpay',  [VnpayController::class,'status'])->name('pay.vnpay.status');

});
