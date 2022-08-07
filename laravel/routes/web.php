<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('', fn (Request $request) => view('index'))->name('home');

Route::middleware('guest')->group(function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('login', 'get_login')->name('login');
        Route::post('login', 'post_login');
        Route::get('register', 'get_register')->name('register');
        Route::post('register', 'post_register');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::controller(PetController::class)->prefix('pet')->name('pet.')->group(function () {
        Route::get('', 'list')->name('list');
        Route::middleware('staff')->group(function () {
            Route::get('create', 'create_get')->name('create');
            Route::post('create', 'create_post');
            Route::post('delete', 'delete')->name('delete');
            Route::get('{pet}', 'edit_get')->name('edit');
            Route::post('{pet}', 'edit_post');
        });
    });

    Route::controller(AppointmentController::class)->prefix('appointment')->name('appointment.')->group(function () {
        Route::get('', 'list')->name('list');
        Route::get('create', 'create_get')->name('create');
        Route::post('create', 'create_post');
        Route::post('delete', 'delete')->name('delete');
        Route::get('{appointment}', 'edit_get')->name('edit');
        Route::post('{appointment}', 'edit_post');
    });
});
