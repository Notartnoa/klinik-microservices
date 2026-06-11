<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $appointments = [
            [
                'patient_id'           => 1,
                'doctor_id'            => 1,
                'appointment_date'     => '2026-04-28',
                'appointment_time'     => '08:00',
                'status'               => 'confirmed',
                'complaint'            => 'Demam tinggi sudah 3 hari, disertai batuk',
                'notes'                => null,
                'consultation_fee'     => 150000,
                'patient_name'         => 'Budi Santoso',
                'doctor_name'          => 'dr. Siti Rahayu, Sp.U',
                'doctor_specialization'=> 'Umum',
            ],
            [
                'patient_id'           => 2,
                'doctor_id'            => 2,
                'appointment_date'     => '2026-04-29',
                'appointment_time'     => '09:00',
                'status'               => 'pending',
                'complaint'            => 'Anak sering rewel dan susah makan',
                'notes'                => null,
                'consultation_fee'     => 200000,
                'patient_name'         => 'Dewi Rahayu',
                'doctor_name'          => 'dr. Budi Hartono, Sp.A',
                'doctor_specialization'=> 'Anak',
            ],
            [
                'patient_id'           => 3,
                'doctor_id'            => 3,
                'appointment_date'     => '2026-04-28',
                'appointment_time'     => '13:00',
                'status'               => 'completed',
                'complaint'            => 'Sakit gigi geraham bawah kanan',
                'notes'                => 'Pasien perlu dicabut gigi geraham, jadwalkan tindakan minggu depan',
                'consultation_fee'     => 175000,
                'patient_name'         => 'Ahmad Fauzi',
                'doctor_name'          => 'dr. Maya Kusuma, Sp.G',
                'doctor_specialization'=> 'Gigi',
            ],
            [
                'patient_id'           => 1,
                'doctor_id'            => 4,
                'appointment_date'     => '2026-04-30',
                'appointment_time'     => '14:00',
                'status'               => 'pending',
                'complaint'            => 'Tekanan darah tinggi dan sering pusing',
                'notes'                => null,
                'consultation_fee'     => 250000,
                'patient_name'         => 'Budi Santoso',
                'doctor_name'          => 'dr. Ahmad Rizki, Sp.PD',
                'doctor_specialization'=> 'Penyakit Dalam',
            ],
            [
                'patient_id'           => 5,
                'doctor_id'            => 1,
                'appointment_date'     => '2026-04-30',
                'appointment_time'     => '10:00',
                'status'               => 'cancelled',
                'complaint'            => 'Flu dan hidung tersumbat',
                'notes'                => 'Pasien membatalkan janji',
                'consultation_fee'     => 150000,
                'patient_name'         => 'Hendra Wijaya',
                'doctor_name'          => 'dr. Siti Rahayu, Sp.U',
                'doctor_specialization'=> 'Umum',
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
