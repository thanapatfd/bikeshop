<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::post('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/product/edit/{id?}',[App\Http\Controllers\ProductController::class, 'edit']);
Route::post('/product/update',[App\Http\Controllers\ProductController::class, 'update']);


Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::post('/category/search', [App\Http\Controllers\CategoryController::class, 'search']);
Route::get('/category/search', [App\Http\Controllers\CategoryController::class, 'search']);
Route::post('/category/search', [App\Http\Controllers\CategoryController::class, 'search']);
Route::get('/category/edit/{id?}',[App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('/category/update',[App\Http\Controllers\CategoryController::class, 'update']);


