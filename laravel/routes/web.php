<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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


Route::controller(LoginController::class)->group(function () {
    Route::get('/login/', 'get')->name('login');
    Route::post('/login', 'post');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register/', 'get')->name('register');
    Route::post('/register', 'post');
});

Route::get('/login', [LoginController::class, 'get'])->name('login');
Route::post('/login', [LoginController::class, 'post']);
Route::get('/register', [RegisterController::class, 'get'])->name('register');
Route::post('/register', [RegisterController::class, 'post']);
