<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

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

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('homepage');
});

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');

Route::get('/tasks/create',  [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks',  [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}',  [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{task}/edit',  [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/user/settings', [UserController::class, 'showSettings'])->name('user.settings');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
});

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

Route::get('/projects/create',  [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects',  [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}',  [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{project}/edit',  [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');