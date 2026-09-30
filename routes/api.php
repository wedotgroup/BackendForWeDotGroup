<?php

use App\Http\Controllers\Api\Frontend\ManagefrontControoler;
use App\Http\Controllers\Api\ManageApiController;
use App\Http\Controllers\Api\ManageOurProductController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/user/logout', [ManageApiController::class, 'LogoutUser']);
    Route::post('/addtocart/{user_id}', [ManageOurProductController::class, 'AddToCart']);
    Route::post('/apply/cuopon', [ManageOurProductController::class, 'ApplyCuopon']);
    Route::put(
        '/cart/{id}',
        [ManageOurProductController::class, 'updateCart']
    );

    Route::delete(
        '/cart/{id}',
        [ManageOurProductController::class, 'removeCart']
    );

    Route::delete(
        '/cart',
        [ManageOurProductController::class, 'clearCart']
    );
    Route::get(
        '/my/cart/items',
        [ManageOurProductController::class, 'MyCartItems']
    );
    Route::post('/order', [PaymentController::class, 'Order']);
});

Route::post('/contact', [ManageApiController::class, 'Enquery']);
Route::post('/hr/form', [ManageApiController::class, 'HrConsulation']);
Route::post('/singin', [ManageApiController::class, 'SingUp']);
Route::post('/login', [ManageApiController::class, 'SingIn']);
Route::get('/products', [ManageOurProductController::class, 'Products']);
Route::get('/products/{slug}', [ManageOurProductController::class, 'ProductDetails']);
Route::get('/herosection', [ManagefrontControoler::class, 'herosection']);
