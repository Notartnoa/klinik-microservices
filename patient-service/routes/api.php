<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('patients/{id}/appointments', [PatientController::class, 'appointments']);
Route::apiResource('patients', PatientController::class);
