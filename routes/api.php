<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
route::get('products', [ProductController::class, 'all']);
route::get('categories', [ProductCategoryController::class, 'all']);

route::post('register', [UserController::class, 'register']);
route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
 Route::get('user', [UserController::class, 'fetch']);
 Route::post('user', [UserController::class, 'updateProfil']);
 Route::post('logout', [UserController::class, 'logout']);

 Route::get('transaction', [TrasactionController::class, 'all']);
 Route::get('checkout', [TransactionController::class, 'checkout']);
});