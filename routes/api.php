<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\MedicalHistoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [authController::class, 'registerUser']);
Route::post('/login', [authController::class, 'loginUser']);
Route::post('/user/{professionalId}/histories', [MedicalHistoryController::class, 'createHistory']);

Route::get('/user/{userId}/histories', [MedicalHistoryController::class, 'getUserMedicalHistories']);
Route::get('/users', [authController::class, 'getAllUsers']);

Route::put('/user/{userId}', [authController::class, 'updateProfile']);
Route::put('/user/{userId}/histories/{historyId}/accept', [MedicalHistoryController::class, 'acceptHistory']);
