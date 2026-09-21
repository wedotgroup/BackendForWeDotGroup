<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CouponManageController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::post('/login', [AdminController::class, 'login'])->name('login');

Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::post('/logout', 'adminlogged')->name('admin.logout');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/users', 'userList')->name('admin.userlist');
        Route::get('/products', 'listing')->name('admin.product.list');
        Route::get('/product/edit/{id}', 'edit')->name('admin.product.edit');
        Route::post('/product/add', 'store')->name('admin.product.store');
        Route::put('/product/update/{id}', 'update')->name('admin.product.update');
        Route::delete('/product/delete/{id}', 'destroy')->name('admin.product.destroy');
        Route::get('/packing/highligh/{index}', 'packingdelete')->name('admin.highlight.delete');
        Route::get('/create', 'index')->name('admin.product.create');

    });
    Route::controller(CouponManageController::class)->group(function () {
        Route::get('/cuopons', 'index')->name('admin.cupons');
        Route::post('/add/cuopon', 'store')->name('admin.cuopon.store');
        Route::get('/create', 'create')->name('admin.cuopon.create');
        Route::post('/update/cuopon/{id}', 'update')->name('admin.cuopon.update');
        Route::get('/edit/coupon/{id}', 'edit')->name('admin.cuopon.edit');
        Route::delete('delete/cuopon/{id}', 'destroy')->name('admin.cuopon.delete');

    });

});
