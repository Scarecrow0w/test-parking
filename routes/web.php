<?php

use App\Http\Controllers\ParkingController;
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

Route::get('/parkings/{parking}', [ParkingController::class, 'show'])->name('parkings.show');

Route::permanentRedirect('/', '/parkings/1');

require __DIR__.'/auth.php';
