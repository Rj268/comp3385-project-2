<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/v1/auth/register', [AuthController::class, 'register']);
Route::post('/v1/auth/login', [AuthController::class, 'login']);
Route::post('/v1/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/v1/car', [CarController::class, 'store'])->middleware('auth:sanctum');


Route::get('/v1/cars', [CarController::class, 'index']);

Route::get('/v1/cars/{car_id}', [CarController::class, 'show']);
Route::get('/v1/search', [CarController::class, 'search']);

Route::post('/v1/cars/{car_id}/favourite', [CarController::class, 'favourite'])->middleware('auth:sanctum');

Route::post('/v1/users/{user_id}/favourites', [CarController::class, 'userFavourites']);
