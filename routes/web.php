<?php

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

Route::get('/', fn() => view('welcome'))
    ->name('home');
Route::resource('tasks', \App\Http\Controllers\TaskController::class)
    ->only(['index', 'create', 'store']);
Route::get('statistics', [\App\Http\Controllers\StatisticController::class, 'index'])
    ->name('statistics.index');
