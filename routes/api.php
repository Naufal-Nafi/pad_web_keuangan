<?php

use App\Http\Controllers\API\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\API\ConsignmentApiController;


// Public routes
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);

// Dashboard routes
Route::prefix('dashboard')->group(function () {
    Route::get('/nicome-percentage/7', [KeuanganController::class, 'getIncomePercentageLast7Days']);
    Route::get('/income-percentage/14', [KeuanganController::class, 'getIncomePercentageLast14Days']);
    Route::get('/income-percentage/30', [KeuanganController::class, 'getIncomePercentageLast30Days']);
    Route::get('/income-percentage/365', [KeuanganController::class, 'getIncomePercentageLast12Months']);
});

// Public consignment routes
Route::get('/consignments', [ConsignmentApiController::class, 'index']);
Route::get('/consignments/{consignment_id}', [ConsignmentApiController::class, 'show']);


// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Protected consignment routes
    Route::prefix('consignments')->group(function () {
        Route::post('/', [ConsignmentApiController::class, 'store']);
        Route::put('/{consignment_id}', [ConsignmentApiController::class, 'update']);
        Route::delete('/{consignment_id}', [ConsignmentApiController::class, 'destroy']);
    });
});