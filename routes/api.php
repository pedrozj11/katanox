<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('room', [RoomController::class, 'index']);
Route::get('room/{id}', [RoomController::class, 'show']);
Route::post('room', [RoomController::class, 'store']);
Route::put('room/{id}', [RoomController::class, 'edit']);
Route::delete('room/{id}', [RoomController::class, 'delete']);

Route::get('hotel', [HotelController::class, 'index']);
Route::get('hotel/{id}', [HotelController::class, 'show']);
Route::post('hotel', [HotelController::class, 'store']);
Route::put('hotel/{id}', [HotelController::class, 'edit']);
Route::delete('hotel/{id}', [HotelController::class, 'delete']);
