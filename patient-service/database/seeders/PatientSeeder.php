<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name'                    => 'Budi Santoso',
                'gender'                  => 'male',
                'birth_date'              => '1990-03-15',
                'nik'                     => '3578011503900001',
                'phone'                   => '081234567890',
                'email'                   => 'budi.santoso@email.com',
                'address'                 => 'Jl. Kenanga No. 12, Surabaya',
                'blood_type'              => 'A',
                'emergency_contact_name'  => 'Siti Santoso',
                'emergency_contact_phone' => '081234567891',
                'status'                  => 'active',
            ],
            [
                'name'                    => 'Dewi Rahayu',
                'gender'                  => 'female',
                'birth_date'              => '1995-07-22',
                'nik'                     => '3578014707950002',
                'phone'                   => '082345678901',
                'email'                   => 'dewi.rahayu@email.com',
                'address'                 => 'Jl. Melati No. 5, Bandung',
                'blood_type'              => 'O',
                'emergency_contact_name'  => 'Andi Rahayu',
                'emergency_contact_phone' => '082345678902',
                'status'                  => 'active',
            ],
            [
                'name'                    => 'Ahmad Fauzi',
                'gender'                  => 'male',
                'birth_date'              => '1985-11-08',
                'nik'                     => '3578010811850003',
                'phone'                   => '083456789012',
                'email'                   => null,
                'address'                 => 'Jl. Mawar No. 33, Jakarta Timur',
                'blood_type'              => 'B',
                'emergency_contact_name'  => 'Fatimah Fauzi',
                'emergency_contact_phone' => '083456789013',
                'status'                  => 'active',
            ],
            [
                'name'                    => 'Rina Marlina',
                'gender'                  => 'female',
                'birth_date'              => '2000-01-30',
                'nik'                     => '3578013001000004',
                'phone'                   => '084567890123',
                'email'                   => 'rina.marlina@email.com',
                'address'                 => 'Jl. Anggrek No. 7, Yogyakarta',
                'blood_type'              => 'AB',
                'emergency_contact_name'  => 'Dian Marlina',
                'emergency_contact_phone' => '084567890124',
                'status'                  => 'inactive',
            ],
            [
                'name'                    => 'Hendra Wijaya',
                'gender'                  => 'male',
                'birth_date'              => '1978-05-19',
                'nik'                     => '3578011905780005',
                'phone'                   => '085678901234',
                'email'                   => 'hendra.w@email.com',
                'address'                 => 'Jl. Dahlia No. 21, Malang',
                'blood_type'              => 'O',
                'emergency_contact_name'  => 'Sri Wijaya',
                'emergency_contact_phone' => '085678901235',
                'status'                  => 'active',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
