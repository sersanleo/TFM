<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetController;
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
    Route::get('login', 'get')->name('login');
    Route::post('login', 'post');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'get')->name('register');
    Route::post('register', 'post');
});
Route::controller(PetController::class)->prefix('pet')->name('pet.')->group(function () {
    Route::get('', 'list')->name('list');
    Route::get('create', 'create_get')->name('create');
    Route::post('create', 'create_post');
    // Route::get('delete', 'delete')->name('delete');
    // Route::get('frgr', 'edit')->name('edit');
});
