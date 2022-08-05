<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\RegisterController;
use App\Models\User;
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

Route::get('', function (Request $request) {
    if (Auth::check()) {
        $token = $request->user()->createToken('API_TOKEN');
        return ['token' => $token->plainTextToken];
    }
    return view('index');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'get')->name('login');
        Route::post('login', 'post');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'get')->name('register');
        Route::post('register', 'post');
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
