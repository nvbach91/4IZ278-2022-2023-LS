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

Route::get('/', [App\Http\Controllers\PublicController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\UserController::class, 'index']);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view("admin");
    });
});

Route::get('/product/{id}', [App\Http\Controllers\PublicController::class, 'product']);
Route::redirect('/product', '/');

View::composer(['layouts.app'], function ($view) {
    $view->with('rootCategories', App\Models\Category::all()->where('category_id', null));
});
