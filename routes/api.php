<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/get-token', function () {
    return \App\Models\ApiToken::where('valid_for', now()->toDateString())->first();
});

Route::middleware('public_apis')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register-client', [AuthController::class, 'registerClient']);
    Route::post('/google', [AuthController::class, 'GoogleTest']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);
});