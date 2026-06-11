<?php

namespace App\Jobs;

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
    }
}
