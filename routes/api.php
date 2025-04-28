<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FavouriteController;

Route::prefix('v1')->group(function () {
    // Auth routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // User profile update
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::put('/user', [AuthController::class, 'update']);

        // Cars
        Route::get('/cars', [CarController::class, 'index']);
        Route::post('/cars', [CarController::class, 'store']);
        Route::get('/cars/{id}', [CarController::class, 'show']);
        Route::post('/cars/{id}/favourite', [FavouriteController::class, 'favourite']);
    });
});
