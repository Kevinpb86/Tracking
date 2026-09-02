<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Public HSE Routes for Testing
Route::get('/hse', [App\Http\Controllers\Api\HseController::class, 'index']);
Route::post('/hse', [App\Http\Controllers\Api\HseController::class, 'store']);

// DO Item API Routes
use App\Http\Controllers\Api\DoItemApiController;

// Public DO Item Routes (you can add auth middleware if needed)
Route::get('/do-items', [DoItemApiController::class, 'index']);
Route::post('/do-items', [DoItemApiController::class, 'store']);
Route::get('/do-items/{id}', [DoItemApiController::class, 'show']);
Route::put('/do-items/{id}', [DoItemApiController::class, 'update']);
Route::delete('/do-items/{id}', [DoItemApiController::class, 'destroy']);
