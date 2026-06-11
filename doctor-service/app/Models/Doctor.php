<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'nip',
        'phone',
        'email',
        'specialization',
        'license_number',
        'experience_years',
        'education',
        'consultation_fee',
        'status',
    ];

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}
