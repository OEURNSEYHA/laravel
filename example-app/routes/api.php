<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthConller;
use App\Http\Controllers\UserController;

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

Route::post('/login',[AuthConller::class,'login']);

// product;
Route::get('/products',[ProductController::class,'index']);

// Route::get('/users',[UserController::class,'alluser']);
Route::middleware('auth:sanctum')->group( function () {
     // Product;
     Route::get('/product/{id}',[ProductController::class,'getone']);
     Route::post('/add',[ProductController::class,'add']);
     Route::put('/update/{id}',[ProductController::class,'update']);
     Route::delete('/delete/{id}',[ProductController::class,'delete']);
}); 