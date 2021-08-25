<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
Route::get('getproduct', [ProductController::class, 'getall']);


Route::middleware('auth:sanctum')->group(function(){
    
    Route::post('addproduct', [ProductController::class, 'create']);
    Route::get('getbyid/{id}', [ProductController::class, 'getbyid']);
    Route::post('updateproduct/{id}', [ProductController::class, 'updateproduct']);
    
    Route::group(['middleware'=>['leveluser']], function () {
        Route::get('getbyid/{id}', [ProductController::class, 'getbyid']);
    });

    Route::group(['middleware'=>['adminlevel']], function(){
        Route::delete('delproduct/{id}', [ProductController::class, 'deleteproduct']);
    });

});
