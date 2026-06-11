<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'status',
        'complaint',
        'notes',
        'consultation_fee',
        'patient_name',
        'doctor_name',
        'doctor_specialization',
    ];
}
