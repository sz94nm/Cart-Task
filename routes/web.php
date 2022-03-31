<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//1- route to the website and dashboard
Route::get('/', [App\Http\Controllers\ProductController::class, 'indexUser'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\ProductController::class, 'indexAdmin'])->name('dash')->middleware('auth','isAdmin');

//2- authentication routes
Auth::routes();
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);


//3- cart routes
Route::resource('cart', CartController::class);
Route::get('/empty', [App\Http\Controllers\CartController::class, 'empty']);

//4- products routes
Route::resource('/products', ProductController::class);

