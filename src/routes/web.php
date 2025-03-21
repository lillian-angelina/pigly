<?php

// routes/web.php
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('weight_logs')->group(function () {
    Route::get('/', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('search', [WeightLogController::class, 'search'])->name('weight_logs.search');
    Route::post('search', [WeightLogController::class, 'search'])->name('weight_logs.search');
    Route::get('{weightLog}', [WeightLogController::class, 'show']);
    Route::get('{weightLog}/update', [WeightLogController::class, 'edit']);
    Route::put('{weightLog}', [WeightLogController::class, 'update']);
    Route::delete('{weightLog}', [WeightLogController::class, 'destroy']);

    Route::get('goal_setting', [WeightTargetController::class, 'goal_setting'])->name('weight_logs.goal_setting');
    Route::get('edit', [WeightTargetController::class, 'edit'])->name('weight_logs.edit');
    Route::put('goal_setting', [WeightTargetController::class, 'update'])->name('weight_logs.update');
});

Route::get('/register/step1', [AuthController::class, 'showRegistrationForm']);
Route::post('/register/step1', [AuthController::class, 'register']);
Route::get('/register/step2', [AuthController::class, 'showInitialGoalForm']);
Route::post('/register/step2', [AuthController::class, 'setInitialGoal']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
