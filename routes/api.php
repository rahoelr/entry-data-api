<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\EntryInstitutionController;
use App\Http\Controllers\EntryuserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/customization/current', [CustomizationController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:manager')->group(function () {
        //kustomisasi
        Route::apiResource('/customization',CustomizationController::class);
        Route::get('customization/active-color', [CustomizationController::class, 'show']);

        //user management
        Route::apiResource('/users',UserManagementController::class);

    });

    Route::middleware('role:manager,data_entry')->group(function () {
        //entry-user
        Route::apiResource('/entry-user',EntryuserController::class);
        Route::get('/entry-user/user/{userId}', [EntryuserController::class, 'showByUserId']);
        Route::put('/entry-user/status/{id}', [EntryuserController::class, 'updateStatus']);
        
        //lembaga
        Route::apiResource('/entry-lembaga',EntryInstitutionController::class);
        Route::get('/entry-lembaga/user/{userId}', [EntryInstitutionController::class, 'showByUserId']);
        Route::put('/entry-lembaga/status/{id}', [EntryInstitutionController::class, 'updateStatus']);
    });
    
    Route::middleware('role:user_kementerian')->group(function () {
        //user-kementerian
        // Route::apiResource('/user-kementerian',EntryuserController::class);
        Route::get('/user-kementerian', [EntryuserController::class, 'index']);
        Route::get('/user-kementerian/{id}', [EntryuserController::class, 'show']);
        Route::get('/user-kementrian/user/{userId}', [EntryuserController::class, 'showByUserId']);

    });
});



