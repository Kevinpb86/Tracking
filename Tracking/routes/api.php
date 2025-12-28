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
