<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DefaultPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertyListController;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\PropertyDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
    return view('welcome');
});

Route::get('/', [DefaultPageController::class, 'getProperties']);

Route::get('/contact', [ContactController::class, 'contact'])->name('contact')->middleware('auth');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send')->middleware('auth');


Route::get('/properties/{property}', [PropertiesController::class, 'show'])->name('properties.show');

Route::get('/properties', [PropertiesController::class, 'index'])->name('propertiesList.index');



//User interested in property function
Route::post('/property/{property}/interested', [PropertyDetailController::class, 'markAsInteresting'])->name('property.interested');
Route::post('/property/{id}/interested', [PropertyDetailController::class, 'addInterest'])->name('property.interested');
Route::delete('/property/{id}/uninterest', [PropertyDetailController::class, 'removeInterest'])->name('property.uninterest');
Route::get('/property/{property}', [PropertyDetailController::class, 'show'])->name('property.show');



Route::middleware(['auth', 'checkUserRole'])->group(function () {
    Route::get('/propertyEditor', [PropertyListController::class, 'index'])->name('property.index');
    //adding
    Route::get('/propertyEditor/create', [PropertyListController::class, 'create'])->name('property.create');
    Route::post('/propertyEditor', [PropertyListController::class, 'store'])->name('property.store');

    // editing
    Route::get('/propertyEditor/{property}/edit', [PropertyListController::class, 'edit'])->name('property.edit');
    Route::put('/propertyEditor/{property}', [PropertyListController::class, 'update'])->name('property.update');

    //deleting
    Route::delete('/propertyEditor/{property}', [PropertyListController::class, 'destroy'])->name('property.destroy');
    Route::delete('/propertyEditor/image/{image}', [PropertyListController::class, 'deleteImage'])->name('image.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/interests', [ProfileController::class, 'interests'])->name('profile.interests');
    Route::get('/property-interests', [UserController::class, 'showProperties'])->name('property.interests');
});


Route::get('auth/github', [AuthenticatedSessionController::class, 'redirectToGitHub'])->name('auth.github');
Route::get('auth/github/callback', [AuthenticatedSessionController::class, 'handleGitHubCallback'])->name('auth.github.callback');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
