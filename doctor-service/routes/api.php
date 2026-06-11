<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

Route::apiResource('doctors', DoctorController::class);
Route::get('doctors/{id}/schedules', [DoctorController::class, 'schedules']);
Route::post('doctors/{id}/schedules', [DoctorController::class, 'addSchedule']);