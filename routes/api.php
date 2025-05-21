<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/dashboard/income-percentage/7', [KeuanganController::class, 'getIncomePercentageLast7Days']);
Route::get('/dashboard/income-percentage/14', [KeuanganController::class, 'getIncomePercentageLast14Days']);
Route::get('/dashboard/income-percentage/30', [KeuanganController::class, 'getIncomePercentageLast30Days']);
Route::get('/dashboard/income-percentage/365', [KeuanganController::class, 'getIncomePercentageLast12Months']);

