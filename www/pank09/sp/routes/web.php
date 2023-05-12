<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

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

Route::get( '/', [EventController::class, 'index'])->name('home');
Route::post('/concert/', [EventController::class, 'store'])->name('event.store');
Route::get( '/concert/{event}', [EventController::class, 'show'])->name('event');
Route::get( '/concert/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::put( '/concert/{event}/update', [EventController::class, 'update'])->name('event.update');
Route::delete( '/concert/{event}/delete', [EventController::class, 'destroy'])->name('event.delete');

Route::post('/concert/{event}', [TicketController::class, 'store']);
Route::post('/concert/{event}/ticket/{ticket}/book', [BookingController::class, 'store'])->name('ticket.book');
Route::get( '/bookings', [BookingController::class, 'index'])->name('bookings');
Route::delete( '/booking/{booking}/unbook', [BookingController::class, 'destroy'])->name('booking.unbook');

Route::get('/concert/{event}/ticket/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
Route::put('/concert/{event}/ticket/{ticket}/update', [TicketController::class, 'update'])->name('ticket.update');
Route::delete('/concert/{event}/ticket/{ticket}/delete', [TicketController::class, 'destroy'])->name('ticket.delete');


// Auth routes
Route::get( 'signin', [AuthController::class, 'signin'])->name('signin');
Route::post('signin', [AuthController::class, 'signinUser']);
Route::get( 'signup', [AuthController::class, 'signup'])->name('signup');
Route::post('signup', [AuthController::class, 'signupUser']);
Route::get( 'signout',[AuthController::class, 'signout'])->name('signout');

// Facebook auth
Route::get('signin/facebook', [AuthController::class, 'facebookLogin'])->name('signin.facebook');
Route::get('signin/facebook/handler', [AuthController::class, 'facebookLoginHandler'])->name('signin.facebook.handler');
