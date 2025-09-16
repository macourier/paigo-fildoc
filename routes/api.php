<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/stats/payslips', [DashboardController::class, 'getPayslipStats']);
    Route::get('/stats/employees', [DashboardController::class, 'getEmployeeStats']);
    Route::get('/ai/suggestions', [DashboardController::class, 'getSuggestions']);
    Route::get('/account/subscription', [DashboardController::class, 'getSubscription']);
    Route::post('/ai/chat', [\App\Http\Controllers\AIChatController::class, 'chat'])->middleware('auth:sanctum');
});
