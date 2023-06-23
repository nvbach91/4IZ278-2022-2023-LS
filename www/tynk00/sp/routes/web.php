<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Livewire\SearchProjects;
use Livewire\Livewire;

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
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});


Route::get('/', [UserController::class, 'dashboard']);

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');

Route::get('/tasks/create',  [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks',  [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}',  [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{task}/edit',  [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/update', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::put('/tasks/{task}/update-status', [TaskController::class, 'complete'])->name('tasks.complete');

Route::middleware('auth')->group(function () {
    Route::get('/user/settings', [UserController::class, 'showSettings'])->name('user.settings');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
});

Route::get('/auth/login', [LoginController::class, 'form'])->name('oauth.login');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/find', [ProjectController::class, 'search'])->name('projects.search');
Route::get('/projects/create',  [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects',  [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}',  [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{project}/edit',  [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/search-projects', SearchProjects::class);

Route::get('/auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('/auth/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');


Route::get('/notes', [NoteController::class, 'index'])->name('notes');
Route::get('/notes/create',  [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes',  [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{note}',  [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/{note}/edit',  [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::get('/tags/create',  [TagController::class, 'create'])->name('tags.create');
Route::post('/tags',  [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{tag}',  [TagController::class, 'show'])->name('tags.show');
Route::get('/tags/{tag}/edit',  [TagController::class, 'edit'])->name('tags.edit');
Route::put('/tags', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

Route::post('/tags/{project}',  [TagController::class, 'attachTagsToProject'])->name('tags.attachToProject');

Route::get('/back', function () {
    $previousUrl = url()->previous();
    return redirect($previousUrl);
})->name('return');
