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

/*
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    });
});
*/

//admin page
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'get'])->name('dashboard');
});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/edit/product/{id}', [App\Http\Controllers\AdminController::class, 'editProductPage'])->name('edit_product_page');
});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::post('/dashboard/edit/product/', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('edit_product');
});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/add/product/new', [App\Http\Controllers\AdminController::class, 'addProductPage'])->name('add_product_page');
});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::post('/dashboard/add/product/', [App\Http\Controllers\AdminController::class, 'addProduct'])->name('add_product');
});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::post('/dashboard/edit/order/status', [App\Http\Controllers\AdminController::class, 'changeStatusOfOrder'])->name('change_order_status');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'returnProduct'])->name('product');

Route::get('/category/{category_id}', [\App\Http\Controllers\ProductController::class, 'returnProductsByCategory'])->name('category');

Route::post('/cart/add/', [App\Http\Controllers\CartController::class, 'add'])->name('add_to_cart');

Route::post('/cart/remove/', [App\Http\Controllers\CartController::class, 'remove'])->name('remove_from_cart');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'get'])->name('cart');

Route::post('/cart/order', [App\Http\Controllers\OrderController::class, 'createOrder'])->name('make_an_order');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'get'])->name('profile');

Route::get('profile/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('profile_edit');

Route::post('profile/update/info', [App\Http\Controllers\UserController::class, 'updateInfo'])->name('profile_edit_submit');

Route::post('profile/update/address', [App\Http\Controllers\UserController::class, 'updateAddress'])->name('profile_address_submit');

Route::get('profile/order/{id}', [App\Http\Controllers\OrderController::class, 'showOrder'])->name('order');


//AUTH2.0
Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
//////

