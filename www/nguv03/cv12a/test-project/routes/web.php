<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
    
    $categoryController = new CategoryController();
    $categories = $categoryController->fetchAll();

    return view('welcome')->with('name', [ 'something' => '321' ])
                          ->with('age', 65)
                          ->with('categories', $categories);
});
