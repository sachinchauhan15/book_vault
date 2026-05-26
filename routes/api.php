<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('throttle:10,1')->group(function (): void {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['auth:api', 'throttle:60,1'])->group(function (): void {
    Route::get('auth/profile', [AuthController::class, 'profile']);
    Route::apiResource('books', BookController::class);
});
