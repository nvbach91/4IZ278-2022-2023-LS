<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view("admin");
    });
});

Route::get('/', [App\Http\Controllers\PublicController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/category/{id}', [App\Http\Controllers\PublicController::class, 'category'])->name('index.category');
Route::get('/product/{id}', [App\Http\Controllers\PublicController::class, 'product'])->name('product');
Route::redirect('/product', '/');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'show'])->name('cart');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/subtract', [App\Http\Controllers\CartController::class, 'subtract'])->name('cart.subtract');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

View::composer(['layouts.app'], function ($view) {
    $view->with('rootCategories', App\Models\Category::all()->where('category_id', null));
});
