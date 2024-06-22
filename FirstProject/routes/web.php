<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    
    return view('welcome');
    
});

// Route::get('/products', function(){
//     return view('products.text');
// });

Route::resource('products', ProductController::class);

// Route::resource('products', UserController::class);
// Route::resource('products', 'products.create');

Route::get('/pros', [ProductController:: class , 'index']);