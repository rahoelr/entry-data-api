<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:manager')->group(function () {
        Route::get('/manager/dashboard', function () {
            return response()->json(['message' => 'Welcome Manager']);
        });
        //kustomisasi
        Route::apiResource('/customization',CustomizationController::class);
        Route::get('customization/active-color', [CustomizationController::class, 'show']);

        //user management
        Route::apiResource('/users',UserManagementController::class);

    });

    Route::middleware('role:data_entry')->group(function () {
        Route::get('/data-entry/dashboard', function () {
            return response()->json(['message' => 'Welcome Data Entry']);
        });
    });

    Route::middleware('role:user_kementerian')->group(function () {
        Route::get('/user-kementerian/dashboard', function () {
            return response()->json(['message' => 'Welcome User Kementerian']);
        });
    });
});



