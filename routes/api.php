<?php

use App\Http\Controllers\Api\ManageApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/contact',[ManageApiController::class, 'Enquery']);
Route::post('/hr/form',[ManageApiController::class, 'HrConsulation']);
