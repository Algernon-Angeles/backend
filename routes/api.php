<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;

Route::get('/health', fn () => response()->json(['status' => 'ok']));

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);

    Route::middleware('must_change_password')->group(function () {
        Route::middleware('role:admin')->group(function () {
            Route::post('/admin/users', [AdminUserController::class, 'store']);
        });

        // Later: other protected routes go here
    });
});
