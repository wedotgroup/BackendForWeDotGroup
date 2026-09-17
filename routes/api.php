<?php

use App\Http\Controllers\Api\ManageApiController;
use App\Http\Controllers\Api\ManageOurProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/user/logout', [ManageApiController::class, 'LogoutUser']);
    Route::post('/addtocart/{user_id}', [ManageOurProductController::class, 'AddToCart']);
    Route::delete('/remove/cart/{user_id}/{product_id}', [ManageOurProductController::class, 'RemoveCart']);
    Route::get('/my/cart/items/{user_id}',[ManageOurProductController::class, 'MyCartItems']);
});

Route::post('/contact', [ManageApiController::class, 'Enquery']);
Route::post('/hr/form', [ManageApiController::class, 'HrConsulation']);
Route::post('/singin', [ManageApiController::class, 'SingUp']);
Route::post('/login', [ManageApiController::class, 'SingIn']);
Route::get('/products', [ManageOurProductController::class, 'Products']);
Route::get('/products/{id}', [ManageOurProductController::class, 'ProductDetails']);
