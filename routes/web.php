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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/form', [\App\Http\Controllers\MainController::class, 'getForm'])->name('form');
Route::get('/form', [\App\Http\Controllers\MainController::class, 'form']);
Route::get('/users', [\App\Http\Controllers\UserController::class, 'showUsers'])->name('users');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
