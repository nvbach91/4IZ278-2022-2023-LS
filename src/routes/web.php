<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/panel', [PanelController::class, 'index'])->middleware('auth');

Route::get('/', [CarouselController::class, 'index'])->name('carousel');
Route::get('/store', [StoreController::class, 'index'])->name('store');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/flush', [CartController::class, 'flush'])->name('cart.flush');

Route::get('auth/github', [AuthenticatedSessionController::class, 'redirectToGitHub'])->name('auth.github');
Route::get('auth/github/callback', [AuthenticatedSessionController::class, 'handleGitHubCallback'])->name('auth.github.callback');




