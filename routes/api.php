<?php

use App\Http\Controllers\Api\Admin\CategoryApiController;
use App\Http\Controllers\Client\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::fallback(function(){return response()->json(['message' => 'Page Not Found'], 404);});
Route::resource('categories', CategoryApiController::class);

