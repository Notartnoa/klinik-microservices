<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'nik',
        'phone',
        'email',
        'address',
        'blood_type',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
    ];
}
