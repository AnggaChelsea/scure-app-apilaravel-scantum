<?php

use App\Http\Controllers\WEB\ProductController;
use Illuminate\Support\Facades\Route;

use App\Models\Products;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\WEB\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [ProductController::class, 'show']);
Route::get('/banned', [ProductController::class, 'show']);
Route::post('/login', [AuthController::class, 'signin']);
Route::post('/register', [AuthController::class, 'signup']);



Route::get('/', function()
{
    $products = Products::all();
   
    return view('pages.home', ['products' => $products]);
});

Route::get('/login', function()
{ 
    return view('auth.login');
});

Route::get('/signin', function()
{ 
    return view('auth.signin');
});