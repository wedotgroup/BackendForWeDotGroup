<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::post('/login', [AdminController::class, 'login'])->name('login');

Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::post('/logout', 'adminlogged')->name('admin.logout');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/users','userList')->name('admin.userlist');
    });

});
