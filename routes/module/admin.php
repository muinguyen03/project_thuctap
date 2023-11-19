<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\Admin\ProductApiController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\CheckRoleAdmin;
use Illuminate\Support\Facades\Route;

Route::fallback(function() {
    return view('404');
});
Route::middleware([CheckAdminLogin::class])->group(function () {
    Route::get('/', function (){ return view('admin.home'); })->name('home');

    Route::get('/banners',[BannerController::class,'index'])->name('banner.index');
    Route::get('/categories',[CategoryController::class,'index'])->name('category.index');
    Route::get('/products',[ProductController::class,'index'])->name('product.index');
    Route::get('/promotions',[PromotionController::class,'index'])->name('promotion.index');

    Route::middleware([CheckRoleAdmin::class])->group(function () {

        Route::resource('banners', BannerController::class)
            ->except(['index','show'])
            ->names([
                'create'  => 'banner.create',
                'store'   => 'banner.store',
                'edit'    => 'banner.edit',
                'update'  => 'banner.update',
                'destroy' => 'banner.del',
            ]);

        Route::resource('categories', CategoryController::class)
            ->except(['index','show'])
            ->names([
                'create'  => 'category.create',
                'store'   => 'category.store',
                'edit'    => 'category.edit',
                'update'  => 'category.update',
                'destroy' => 'category.del',
            ]);

            Route::resource('products', ProductController::class)
            ->except(['index','show'])
            ->names([
                'create'  => 'product.create',
                'store'   => 'product.store',
                'edit'    => 'product.edit',
                'update'  => 'product.update',
                'destroy' => 'product.del',
            ]);
    });

    Route::resource('users', UserController::class)
        ->except(['show'])
        ->names([
            'index'   => 'users.index',
            'store'   => 'users.add',
            'edit'    => 'users.edit',
            'update'  => 'users.update',
            'destroy' => 'users.del',
        ]);

    Route::resource('orders', OrderController::class)
        ->except(['create', 'store', 'edit'])
        ->names([
            'index'   => 'order.index',
            'show'    => 'order.show',
            'update'  => 'order.update',
            'destroy' => 'order.del',
        ]);

        Route::prefix('orders/update')->group(function () {
            Route::put('/carriers/{id}',[OrderController::class,'updateCarries'])->name('order.update.carriers');
            Route::put('/status/payment/{id}',[OrderController::class,'updatePayment'])->name('order.update.status.payment');
        });


    Route::resource('promotions', PromotionController::class)
        ->except(['index','show'])
        ->names([
            'create' => 'promotion.create',
            'store' => 'promotion.store',
            'edit' => 'promotion.edit',
            'update' => 'promotion.update',
            'destroy' => 'promotion.del',
        ]);

    Route::prefix('trash')->group(function () {

        Route::prefix('banners')->group(function () {
            Route::get('/',[BannerController::class,'trash'])->name('banner.trash');
            Route::middleware([CheckRoleAdmin::class])->group(function () {
                Route::post('/restore/{id}',[BannerController::class,'restore'])->name('banner.restore');
                Route::delete('/force-delete/{id}',[BannerController::class,'force'])->name('banner.force.delete');
                Route::delete('/delete/all',[BannerController::class,'deleteAll'])->name('banner.delete.all');

            });
        });

        Route::prefix('categories')->group(function () {
            Route::get('/',[CategoryController::class,'trash'])->name('category.trash');
            Route::middleware([CheckRoleAdmin::class])->group(function () {
                Route::post('/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
                Route::delete('/force-delete/{id}',[CategoryController::class,'force'])->name('category.force.delete');
                Route::delete('/delete/all',[CategoryController::class,'deleteAll'])->name('category.delete.all');
            });
        });

        Route::prefix('products')->group(function () {
            Route::get('/',[ProductController::class,'trash'])->name('product.trash');
            Route::middleware([CheckRoleAdmin::class])->group(function () {
                Route::post('/restore/{id}',[ProductController::class,'restore'])->name('product.restore');
                Route::delete('/force-delete/{id}',[ProductController::class,'force'])->name('product.force.delete');
                Route::delete('/delete/all',[ProductController::class,'deleteAll'])->name('product.delete.all');

            });
        });

        Route::prefix('users')->group(function () {
            Route::get('/',[UserController::class,'trash'])->name('users.trash');
            Route::middleware([CheckRoleAdmin::class])->group(function () {
                Route::post('/restore/{id}',[UserController::class,'restore'])->name('users.restore');
                Route::delete('/force-delete/{id}',[UserController::class,'force'])->name('users.force.delete');
                Route::delete('/delete/all',[UserController::class,'deleteAll'])->name('users.delete.all');

            });
        });

        Route::prefix('promotions')->group(function () {
            Route::get('/',[PromotionController::class,'trash'])->name('promotion.trash');
            Route::middleware([CheckRoleAdmin::class])->group(function () {
                Route::post('/restore/{id}',[PromotionController::class,'restore'])->name('promotion.restore');
                Route::delete('/force-delete/{id}',[PromotionController::class,'force'])->name('promotion.force.delete');
            });
        });
    });
    Route::prefix('api')->group(function () {
        Route::get('/products', [ProductApiController::class, 'index'])->name('product.api.index');
    });


});
