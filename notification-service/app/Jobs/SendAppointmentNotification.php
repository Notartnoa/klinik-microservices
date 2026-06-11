<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendAppointmentNotification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public array $appointment,
        public string $type
    ) {}

    public function handle(): void
    {
        $message = $this->buildMessage($this->type, $this->appointment);

        Notification::create([
            'type'             => $this->type,
            'appointment_id'   => $this->appointment['id'],
            'patient_id'       => $this->appointment['patient_id'],
            'doctor_id'        => $this->appointment['doctor_id'],
            'patient_name'     => $this->appointment['patient_name'],
            'doctor_name'      => $this->appointment['doctor_name'],
            'appointment_date' => $this->appointment['appointment_date'],
            'appointment_time' => $this->appointment['appointment_time'],
            'status'           => $this->appointment['status'],
            'message'          => $message,
            'channel'          => 'system',
            'sent_status'      => 'sent',
        ]);
    }

    private function buildMessage(string $type, array $appt): string
    {
        return match($type) {
            'appointment_created'   => "Appointment baru telah dibuat untuk pasien {$appt['patient_name']} dengan Dr. {$appt['doctor_name']} pada {$appt['appointment_date']} pukul {$appt['appointment_time']}.",
            'appointment_updated'   => "Appointment pasien {$appt['patient_name']} telah diupdate. Status: {$appt['status']}.",
            'appointment_cancelled' => "Appointment pasien {$appt['patient_name']} dengan Dr. {$appt['doctor_name']} pada {$appt['appointment_date']} telah dibatalkan.",
            default                 => "Notifikasi appointment untuk {$appt['patient_name']}.",
        };
    }
}
