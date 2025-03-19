<?php

// routes/web.php
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
Route::get('weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
Route::get('weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');
Route::get('/weight_logs/{weightLog}', [WeightLogController::class, 'show']);
Route::get('/weight_logs/{weightLog}/update', [WeightLogController::class, 'edit']);
Route::put('/weight_logs/{weightLog}', [WeightLogController::class, 'update']);
Route::delete('/weight_logs/{weightLog}', [WeightLogController::class, 'destroy']);

Route::get('/wight_logs/goal_setting', [WeightTargetController::class, 'edit'])->name('weight_logs.goal_setting');
Route::put('/wight_logs/goal_setting', [WeightTargetController::class, 'update'])->name('weight_logs.update');

Route::get('/register/step1', [AuthController::class, 'showRegistrationForm']);
Route::post('/register/step1', [AuthController::class, 'register']);
Route::get('/register/step2', [AuthController::class, 'showInitialGoalForm']);
Route::post('/register/step2', [AuthController::class, 'setInitialGoal']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
