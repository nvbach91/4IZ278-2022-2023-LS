<?php

use App\Http\Controllers\GalaxyController;
use App\Models\Galaxy;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/galaxies', function () {
    $galaxiesController = new GalaxyController();
    $galaxies = $galaxiesController->fetchAll();
    return view('galaxies')->with('galaxies', $galaxies);
});