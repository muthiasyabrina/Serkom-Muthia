<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/',[productController::class, 'landing']) 
->name('landing');
   
Route::resource('produk', ProductController::class)
->except(['show'])
->parameters(['produk' => 'produk']);

