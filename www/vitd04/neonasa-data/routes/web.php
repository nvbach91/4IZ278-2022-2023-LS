<?php

use App\Http\Controllers\GalaxyController;
use App\Http\Controllers\SpaceStationController;
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

Route::get('/', [GalaxyController::class, 'all']);
Route::get('/galaxy/{id}', [GalaxyController::class, 'show']);
Route::get('/space-stations', [SpaceStationController::class, 'all']);
Route::get('/space-station/{id}', [SpaceStationController::class, 'show']);