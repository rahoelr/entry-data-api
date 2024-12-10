<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\EntryInstitutionController;
use App\Http\Controllers\EntryuserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SyncController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/customization/current', [CustomizationController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:manager')->group(function () {
        Route::get('/manager/dashboard', function () {
            return response()->json(['message' => 'Welcome Manager']);
        });
        //kustomisasi
        Route::apiResource('/customization',CustomizationController::class);
        Route::get('customization/active-color', [CustomizationController::class, 'show']);

        //sinkronisasi
        Route::post('/sync/save', [SyncController::class, 'saveEndpoint']);
        Route::post('/sync/now', [SyncController::class, 'syncNow']);
        Route::get('/sync/logs', [SyncController::class, 'getLogs']);

        //user management
        Route::apiResource('/users',UserManagementController::class);

    });

    Route::middleware('role:data_entry')->group(function () {
        Route::get('/data-entry/dashboard', function () {
            return response()->json(['message' => 'Welcome Data Entry']);
        });
        Route::apiResource('/entry-user',EntryuserController::class);
        Route::get('/entry-user/user/{userId}', [EntryuserController::class, 'showByUserId']);
        Route::put('/entry-user/status/{id}', [EntryuserController::class, 'updateStatus']);
        Route::apiResource('/entry-lembaga',EntryInstitutionController::class);
        Route::get('/entry-lembaga/user/{userId}', [EntryInstitutionController::class, 'showByUserId']);
        Route::put('/entry-lembaga/status/{id}', [EntryuserController::class, 'updateStatus']);
    });

    Route::middleware('role:user_kementerian')->group(function () {
        Route::get('/user-kementerian/dashboard', function () {
            return response()->json(['message' => 'Welcome User Kementerian']);
        });
    });
});



