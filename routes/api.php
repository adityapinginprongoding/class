<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductCategoryController;

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
});