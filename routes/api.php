<?php

use App\Http\Controllers\Api\ParkingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(ParkingController::class)
    ->middleware('auth:sanctum')
    ->name('parking.')
    ->prefix('parking')
    ->group(function () {
    Route::post('/{parking}/start', 'start')->name('start');
    Route::post('/{parking}/finish', 'finish')->name('finish');
});
