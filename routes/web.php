<?php

use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\RateController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
Route::fallback(function() {
    return view('404');
});
Route::get('/404', function (){ return view('404'); })->name('404');
Route::get('/permission-denied', function (){ return view('permission'); })->name('permission-denied');

Route::get('/',                     [ClientController::class,'home'])->name('client.home');
Route::get('/shop',                 [ClientController::class,'shop'])->name('client.shop');
Route::get('/about',                [ClientController::class,'about'])->name('client.about');
Route::get('/contact',              [ClientController::class,'contact'])->name('client.contact');
Route::get('/product-detail/{id}',  [ClientController::class,'product_detail'])->name('client.product_detail');
Route::get('/search',               [ClientController::class,'search'])->name('client.search');
Route::post('/rate/list/{id}',      [RateController::class,'index'])->name('client.rate.list');

Route::middleware([CheckLogin::class])->group(function () {
    Route::post('/rate/add',  [RateController::class,'store'])->name('client.rate.add');

    Route::get('/profile',  [ClientController::class,'profile'])->name('client.profile');
    Route::get('/cart',     [ClientController::class,'cart'])->name('client.cart');
    Route::get('/checkout', [ClientController::class,'checkout'])->name('client.checkout');
    Route::post('/check-code', [CheckoutController::class, 'checkCode']);

});
