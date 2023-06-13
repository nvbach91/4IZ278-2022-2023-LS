<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;

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

/** MainController.php */
Route::get('/', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);
Route::get('/contact', [MainController::class, 'contact']);

/** RoomController.php */
Route::get('/rooms', [RoomController::class, 'listRooms']);
Route::get('/studios', [RoomController::class, 'listStudios']);
Route::get('/rooms/{room_id}', [RoomController::class, 'showRoom']);

/** UserController.php */
Route::get('/register', [UserController::class, 'showRegistration'])->middleware('guest');
Route::get('/login', [UserController::class, 'showLogin'])->name('login')->middleware('guest');
Route::get('/user', [UserController::class, 'showSettings']);

Route::post('registration', [UserController::class, 'storeUser'])->name('registration');
Route::post('sign-in', [UserController::class, 'authenticate'])->name('sign-in');
Route::post('logout', [UserController::class, 'logout'])->name('logout');

/** BookingController.php */
Route::get('/bookings', [BookingController::class, 'showBookings']);
