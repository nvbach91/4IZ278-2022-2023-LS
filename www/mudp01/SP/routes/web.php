<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;

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
    return view('homepage');
});

Route::get('/register', function () {
    if(!session()->exists('id')){
        return view('register');
        }
        else{
            return redirect('/');
        }
});

Route::post('/register', [UserController::class,'registerUser']);

Route::get('/login', function () {
    if(!session()->exists('id')){
    return view('login');
    }
    else{
        return redirect('/');
    }
});

Route::post('/login', [UserController::class,'loginUser']);

Route::get('/logout', function () {
    if(session()->exists('id')){
        session()->flush();
    }
    return redirect('/login');
});

Route::get('/goods', [OfferController::class,'getActiveOffer']);

Route::post('/goods', [OfferController::class,'addToCart']);

Route::get('/cart', [CartController::class,'displayCart']);

Route::post('/cart', [CartController::class,'cartAction']);

Route::get('/adminPanel', [AdminController::class,'handleGet']);

Route::post('/adminPanel', [AdminController::class,'handlePost']);

Route::get('/myOrders', [OrderController::class,'displayMyOrders']);