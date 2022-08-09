<?php

use App\Http\Controllers\AppointmentAPIController;
use App\Http\Controllers\PetAPIController;
use App\Http\Controllers\PetRaceAPIController;
use App\Http\Controllers\VetAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum', 'api.headers')->group(function () {
    Route::apiResources([
        'pet' => PetAPIController::class,
        'appointment' => AppointmentAPIController::class,
    ]);
    Route::resource('petrace', PetRaceAPIController::class)->only(['index']);
    Route::resource('vet', VetAPIController::class)->only(['index']);
});
