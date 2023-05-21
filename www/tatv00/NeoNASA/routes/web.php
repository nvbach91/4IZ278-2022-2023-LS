<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalaxyController;
use App\Http\Controllers\SpaceStationController;

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
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('galaxies', GalaxyController::class);
Route::resource('space_stations', SpaceStationController::class);

Route::post('/space_stations/copy/{space_stations}',  [SpaceStationController::class, 'copy'])->name('space_stations.copy');

Route::delete('/galaxies/clear/{galaxy}',  [GalaxyController::class, 'clear'])->name('galaxies.clear');