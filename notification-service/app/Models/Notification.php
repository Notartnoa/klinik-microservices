<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'appointment_id',
        'patient_id',
        'doctor_id',
        'patient_name',
        'doctor_name',
        'appointment_date',
        'appointment_time',
        'status',
        'message',
        'channel',
        'sent_status',
    ];
}
