<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessNotification implements ShouldQueue
{
    use Queueable;

    public function __construct(public array $data) {}

    public function handle(): void
    {
        $type    = $this->data['type'];
        $appt    = $this->data['appointment'];
        $message = $this->buildMessage($type, $appt);

        Notification::create([
            'type'             => $type,
            'appointment_id'   => $appt['id'],
            'patient_id'       => $appt['patient_id'],
            'doctor_id'        => $appt['doctor_id'],
            'patient_name'     => $appt['patient_name'],
            'doctor_name'      => $appt['doctor_name'],
            'appointment_date' => $appt['appointment_date'],
            'appointment_time' => $appt['appointment_time'],
            'status'           => $appt['status'],
            'message'          => $message,
            'channel'          => 'system',
            'sent_status'      => 'sent',
        ]);
    }

    private function buildMessage(string $type, array $appt): string
    {
        return match($type) {
            'appointment_created' => "Appointment baru telah dibuat untuk pasien {$appt['patient_name']} dengan Dr. {$appt['doctor_name']} pada {$appt['appointment_date']} pukul {$appt['appointment_time']}.",
            'appointment_updated' => "Appointment pasien {$appt['patient_name']} telah diupdate. Status: {$appt['status']}.",
            'appointment_cancelled' => "Appointment pasien {$appt['patient_name']} dengan Dr. {$appt['doctor_name']} pada {$appt['appointment_date']} telah dibatalkan.",
            default => "Notifikasi appointment untuk {$appt['patient_name']}.",
        };
    }
}
