<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\DoctorSchedule;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name'             => 'dr. Siti Rahayu, Sp.U',
                'gender'           => 'female',
                'birth_date'       => '1985-04-12',
                'nip'              => 'NIP-2025-001',
                'phone'            => '081111222233',
                'email'            => 'siti.rahayu@klinik.com',
                'specialization'   => 'Umum',
                'license_number'   => 'STR-2025-001',
                'experience_years' => 10,
                'education'        => 'S1 Kedokteran Umum - Universitas Airlangga',
                'consultation_fee' => 150000,
                'schedules' => [
                    ['day' => 'monday',    'start_time' => '08:00', 'end_time' => '12:00', 'max_patients' => 20],
                    ['day' => 'wednesday', 'start_time' => '08:00', 'end_time' => '12:00', 'max_patients' => 20],
                    ['day' => 'friday',    'start_time' => '08:00', 'end_time' => '12:00', 'max_patients' => 20],
                ],
            ],
            [
                'name'             => 'dr. Budi Hartono, Sp.A',
                'gender'           => 'male',
                'birth_date'       => '1980-08-25',
                'nip'              => 'NIP-2025-002',
                'phone'            => '082222333344',
                'email'            => 'budi.hartono@klinik.com',
                'specialization'   => 'Anak',
                'license_number'   => 'STR-2025-002',
                'experience_years' => 15,
                'education'        => 'S1 Kedokteran - Universitas Indonesia, Sp.A - RSCM Jakarta',
                'consultation_fee' => 200000,
                'schedules' => [
                    ['day' => 'tuesday',  'start_time' => '09:00', 'end_time' => '13:00', 'max_patients' => 15],
                    ['day' => 'thursday', 'start_time' => '09:00', 'end_time' => '13:00', 'max_patients' => 15],
                    ['day' => 'saturday', 'start_time' => '08:00', 'end_time' => '11:00', 'max_patients' => 10],
                ],
            ],
            [
                'name'             => 'dr. Maya Kusuma, Sp.G',
                'gender'           => 'female',
                'birth_date'       => '1990-11-03',
                'nip'              => 'NIP-2025-003',
                'phone'            => '083333444455',
                'email'            => 'maya.kusuma@klinik.com',
                'specialization'   => 'Gigi',
                'license_number'   => 'STR-2025-003',
                'experience_years' => 7,
                'education'        => 'S1 Kedokteran Gigi - Universitas Gadjah Mada',
                'consultation_fee' => 175000,
                'schedules' => [
                    ['day' => 'monday',    'start_time' => '13:00', 'end_time' => '17:00', 'max_patients' => 12],
                    ['day' => 'wednesday', 'start_time' => '13:00', 'end_time' => '17:00', 'max_patients' => 12],
                    ['day' => 'friday',    'start_time' => '13:00', 'end_time' => '17:00', 'max_patients' => 12],
                ],
            ],
            [
                'name'             => 'dr. Ahmad Rizki, Sp.PD',
                'gender'           => 'male',
                'birth_date'       => '1978-02-17',
                'nip'              => 'NIP-2025-004',
                'phone'            => '084444555566',
                'email'            => 'ahmad.rizki@klinik.com',
                'specialization'   => 'Penyakit Dalam',
                'license_number'   => 'STR-2025-004',
                'experience_years' => 20,
                'education'        => 'S1 Kedokteran - Universitas Diponegoro, Sp.PD - RSUP Dr. Kariadi',
                'consultation_fee' => 250000,
                'schedules' => [
                    ['day' => 'tuesday',  'start_time' => '14:00', 'end_time' => '18:00', 'max_patients' => 15],
                    ['day' => 'thursday', 'start_time' => '14:00', 'end_time' => '18:00', 'max_patients' => 15],
                ],
            ],
        ];

        foreach ($doctors as $doctorData) {
            $schedules = $doctorData['schedules'];
            unset($doctorData['schedules']);

            $doctor = Doctor::create($doctorData);

            foreach ($schedules as $schedule) {
                DoctorSchedule::create([
                    'doctor_id'    => $doctor->id,
                    'day'          => $schedule['day'],
                    'start_time'   => $schedule['start_time'],
                    'end_time'     => $schedule['end_time'],
                    'max_patients' => $schedule['max_patients'],
                    'status'       => 'available',
                ]);
            }
        }
    }
}
