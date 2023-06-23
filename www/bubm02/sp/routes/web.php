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
    Route::get('/dashboard', [App\Http\Controllers\OrderController::class, 'showAdminAll'])->name('order.admin.show.all');
    Route::get('/dashboard/order/{id}', [App\Http\Controllers\OrderController::class, 'showAdmin'])->name('order.admin.show');
    Route::get('/dashboard/order/approve/{id}', [App\Http\Controllers\OrderController::class, 'denyAdmin'])->name('order.admin.approve');
    Route::get('/dashboard/order/deny/{id}', [App\Http\Controllers\OrderController::class, 'approveAdmin'])->name('order.admin.deny');
});

Route::get('/', [App\Http\Controllers\PublicController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/category/{id}', [App\Http\Controllers\PublicController::class, 'category'])->name('category');
Route::get('/product/{id}', [App\Http\Controllers\PublicController::class, 'product'])->name('product');
Route::redirect('/product', '/');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'profileUpdate'])->name('profile.update');
Route::post('/profile/adress/add', [App\Http\Controllers\UserController::class, 'addAdress'])->name('adress.add');
Route::post('/profile/adress/remove', [App\Http\Controllers\UserController::class, 'removeAdress'])->name('adress.remove');

Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/subtract', [App\Http\Controllers\CartController::class, 'subtract'])->name('cart.subtract');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'show'])->name('cart.show');
});

Route::post('/order/submit', [App\Http\Controllers\OrderController::class, 'submit'])->name('order.submit');
//Route::get('/order', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');
Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');

//Google
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
//Facebook
Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);


Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');
View::composer(['layouts.app'], function ($view) {
    $view->with('rootCategories', App\Models\Category::all()->where('category_id', null));
});
