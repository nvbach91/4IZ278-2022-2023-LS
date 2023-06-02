<?php

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
    return ['Laravel' => app()->version()];
});

Route::get('/link', function () {
    Artisan::call('storage:link');
    $target = '/home/httpd/html/users/vitd04/sp/storage/app/public';
    $shortcut = '/home/httpd/html/users/vitd04/sp/public/storage';
    symlink($target, $shortcut);
    $target2 = '/home/httpd/html/users/vitd04/sp/public';
    $shortcut2 = '/home/httpd/html/users/vitd04/sp-api';
    symlink($target2, $shortcut2);
});

require __DIR__ . '/auth.php';