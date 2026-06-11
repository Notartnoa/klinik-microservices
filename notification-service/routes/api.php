<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('notifications', [NotificationController::class, 'index']);
Route::get('notifications/{id}', [NotificationController::class, 'show']);
Route::get('notifications/patient/{patientId}', [NotificationController::class, 'byPatient']);
Route::get('notifications/appointment/{appointmentId}', [NotificationController::class, 'byAppointment']);
