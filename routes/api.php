<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', UserController::class.'@register');

Route::post('login', UserController::class.'@login');

Route::get('getProducts', ProductController::class.'@allproducts');

Route::get('getProduct/{id}', ProductController::class.'@findproduct');

Route::post('addProduct', ProductController::class.'@addproduct')->middleware('auth:sanctum');

Route::delete('deleteProduct/{id}', ProductController::class.'@deleteproduct');

Route::put('updateProduct/{id}', ProductController::class.'@updateproduct');




