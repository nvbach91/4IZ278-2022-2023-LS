<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
})->name('main');

Auth::routes();

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'returnProduct'])->name('product');

Route::get('/category/{category_id}', [\App\Http\Controllers\ProductController::class, 'returnProductsByCategory'])->name('category');

Route::post('/cart/add/', [App\Http\Controllers\CartController::class, 'add'])->name('add_to_cart');

Route::post('/cart/remove/', [App\Http\Controllers\CartController::class, 'remove'])->name('remove_from_cart');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'get'])->name('cart');

Route::post('/cart/order', [App\Http\Controllers\OrderController::class, 'createOrder'])->name('make_an_order');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'get'])->name('profile');


//AUTH2.0
Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
//////

