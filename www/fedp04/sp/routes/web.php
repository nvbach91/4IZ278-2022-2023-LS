<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'homeRedirect']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/order/{id}', [App\Http\Controllers\HomeController::class, 'order'])->name('order');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'get'])->name('cart');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/minus', [App\Http\Controllers\CartController::class, 'minus'])->name('cart.minus');
Route::post('/order/make', [App\Http\Controllers\OrderController::class, 'submit'])->name('make.order');
Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('order');
Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'showAll'])->name('orders');


Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);



Route::middleware(['auth', 'isAdmin'])->group(function () {
Route::get('/dashboard', function () {
    return "Admin dashboard";
});
});

