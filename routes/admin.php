<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CouponManageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ItConsultancyController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\ManagementCunsoltancyController;
use App\Http\Controllers\Backend\PartnersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::get('/viewfps', [AdminController::class, 'viewfps']);
Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('admin.forget.password');

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
    Route::get('/orders', [ProductController::class, 'orders'])->name('admin.orders');
    Route::get('/payments', [ProductController::class, 'payments'])->name('admin.payments');

    Route::controller(AboutUsController::class)->group(function () {
        Route::get('about/company', 'index')->name('admin.about.company');
        Route::get('about/company/create', 'create')->name('admin.about.company.create');
        Route::post('about/company/store', 'store')->name('admin.about.company.store');
        Route::get('about/company/{id}/edit', 'edit')->name('admin.about.company.edit');
        Route::post('about/company/{id}/update', 'update')->name('admin.about.company.update');
        Route::delete('about/company/{id}/delete', 'destroy')->name('admin.about.company.destroy');

        Route::get('about/ceo', 'index')->name('admin.about.ceo');
        Route::get('about/ceo/create', 'create')->name('admin.about.ceo.create');
        Route::post('about/ceo/store', 'store')->name('admin.about.ceo.store');
        Route::get('about/ceo/{id}/edit', 'edit')->name('admin.about.ceo.edit');
        Route::post('about/ceo/{id}/update', 'update')->name('admin.about.ceo.update');
        Route::delete('about/ceo/{id}/delete', 'destroy')->name('admin.about.company.destroy');

        Route::get('about/missin', 'index')->name('admin.about.missin');
        Route::get('about/missin/create', 'create')->name('admin.about.missin.create');
        Route::post('about/missin/store', 'store')->name('admin.about.missin.store');
        Route::get('about/missin/{id}/edit', 'edit')->name('admin.about.missin.edit');
        Route::post('about/missin/{id}/update', 'update')->name('admin.about.missin.update');
        Route::delete('about/missin/{id}/delete', 'destroy')->name('admin.about.company.destroy');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('hero', 'index')->name('admin.hero');
        Route::get('hero/create', 'create')->name('admin.hero.create');
        Route::post('hero/store', 'store')->name('admin.hero.store');
        Route::get('hero/{id}/edit', 'edit')->name('admin.hero.edit');
        Route::post('hero/{id}/update', 'update')->name('admin.hero.update');
        Route::delete('hero/{id}/delete', 'destroy')->name('admin.hero.destroy');

        Route::get('hero/whychoose', 'index')->name('admin.hero.whychoose');
        Route::get('hero/whychoose/create', 'create')->name('admin.hero.whychoose.create');
        Route::post('hero/whychoose/store', 'store')->name('admin.hero.whychoose.store');
        Route::get('hero/whychoose/{id}/edit', 'edit')->name('admin.hero.whychoose.edit');
        Route::post('hero/whychoose/{id}/update', 'update')->name('admin.hero.whychoose.update');
        Route::delete('hero/whychoose/{id}/delete', 'destroy')->name('admin.hero.whychoose.destroy');
    });

    Route::controller(ItConsultancyController::class)->group(function () {
        Route::get('itconsultancy/category', 'index')->name('admin.itconsultancy.category');
        Route::get('itconsultancy/category/create', 'create')->name('admin.itconsultancy.category.create');
        Route::post('itconsultancy/category/store', 'store')->name('admin.itconsultancy.category.store');
        Route::get('itconsultancy/category/{id}/edit', 'edit')->name('admin.itconsultancy.category.edit');
        Route::post('itconsultancy/category/{id}/update', 'update')->name('admin.itconsultancy.category.update');
        Route::delete('itconsultancy/category/{id}/delete', 'destroy')->name('admin.itconsultancy.category.destroy');

        Route::get('itconsultancy/service', 'index')->name('admin.itconsultancy.service');
        Route::get('itconsultancy/service/create', 'create')->name('admin.itconsultancy.service.create');
        Route::post('itconsultancy/service/store', 'store')->name('admin.itconsultancy.service.store');
        Route::get('itconsultancy/service/{id}/edit', 'edit')->name('admin.itconsultancy.service.edit');
        Route::post('itconsultancy/service/{id}/update', 'update')->name('admin.itconsultancy.service.update');
        Route::delete('itconsultancy/service/{id}/delete', 'destroy')->name('admin.itconsultancy.service.destroy');
    });

    Route::controller(ManagementCunsoltancyController::class)->group(function () {

        Route::get('manageconsultancy/category', 'index')->name('admin.manageconsultancy.category');
        Route::get('manageconsultancy/category/create', 'create')->name('admin.manageconsultancy.category.create');
        Route::post('manageconsultancy/category/store', 'store')->name('admin.manageconsultancy.category.store');
        Route::get('manageconsultancy/category/{id}/edit', 'edit')->name('admin.manageconsultancy.category.edit');
        Route::post('manageconsultancy/category/{id}/update', 'update')->name('admin.manageconsultancy.category.update');
        Route::delete('manageconsultancy/category/{id}/delete', 'destroy')->name('admin.manageconsultancy.category.destroy');

        Route::get('manageconsultancy/service', 'index')->name('admin.manageconsultancy.service');
        Route::get('manageconsultancy/service/create', 'create')->name('admin.manageconsultancy.service.create');
        Route::post('manageconsultancy/service/store', 'store')->name('admin.manageconsultancy.service.store');
        Route::get('manageconsultancy/service/{id}/edit', 'edit')->name('admin.manageconsultancy.service.edit');
        Route::post('manageconsultancy/service/{id}/update', 'update')->name('admin.manageconsultancy.service.update');
        Route::delete('manageconsultancy/service/{id}/delete', 'destroy')->name('admin.manageconsultancy.service.destroy');
    });
    Route::controller(LocationController::class)->group(function () {
        Route::get('location', 'index')->name('admin.location');
        Route::get('location/create', 'create')->name('admin.location.create');
        Route::post('location/store', 'store')->name('admin.location.store');
        Route::get('location/{id}/edit', 'edit')->name('admin.location.edit');
        Route::post('location/{id}/update', 'update')->name('admin.location.update');
        Route::delete('location/{id}/delete', 'destroy')->name('admin.location.destroy');
    });

    Route::controller(PartnersController::class)->group(function () {
        Route::get('partner', 'index')->name('admin.partner');
        Route::get('partner/create', 'create')->name('admin.partner.create');
        Route::post('partner/store', 'store')->name('admin.partner.store');
        Route::get('partner/{id}/edit', 'edit')->name('admin.partner.edit');
        Route::post('partner/{id}/update', 'update')->name('admin.partner.update');
        Route::delete('partner/{id}/delete', 'destroy')->name('admin.partner.destroy');
    });

});
