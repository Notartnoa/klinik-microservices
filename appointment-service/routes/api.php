<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::get('appointments/patient/{patientId}', [AppointmentController::class, 'byPatient']);
Route::get('appointments/doctor/{doctorId}', [AppointmentController::class, 'byDoctor']);
Route::apiResource('appointments', AppointmentController::class);
