<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PublicController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SpecialtyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/login', function() {
    return response()->json(['message' => 'Login endpoint no implementado'], 404);
})->name('login');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

Route::apiResource('appointments', AppointmentController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('doctors', DoctorController::class);
    Route::apiResource('specialties', SpecialtyController::class);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('schedules', ScheduleController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('payments', PaymentController::class);
});

Route::post('/generate-slots', [ScheduleController::class, 'generateSlots']);

Route::prefix('public')->group(function () {
    Route::get('/specialties', [PublicController::class, 'getSpecialties']);
    Route::get('/doctors', [PublicController::class, 'getDoctorsBySpecialty']);
});