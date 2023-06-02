<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MenuSectionController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RestaurantController::class)->group(function () {
    // Route::get('/restaurants/{id}', 'show');
    Route::get('/restaurants/search', 'search');
    Route::get('/restaurants/detail', 'getRestaurantDetail');
    Route::middleware(['auth:sanctum'])->post('/restaurants', 'store');
    Route::middleware(['auth:sanctum'])->put('/restaurants', 'update');
    Route::middleware(['auth:sanctum'])->get('/restaurants', 'getMyRestaurants');
});

Route::controller(MenuSectionController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->post('/menu-sections', 'store');
    Route::middleware(['auth:sanctum'])->delete('/menu-sections', 'destroy');
});

Route::controller(AssetController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->post('/assets/upload', 'storeImage');
    Route::middleware(['auth:sanctum'])->get('/assets', 'getAssets');
});

Route::controller(MenuItemController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->post('/menu-items', 'store');
    Route::middleware(['auth:sanctum'])->delete('/menu-items', 'destroy');
});

Route::controller(RatingController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->post('/ratings', 'store');
    Route::middleware(['auth:sanctum'])->get('/ratings', 'get');
});