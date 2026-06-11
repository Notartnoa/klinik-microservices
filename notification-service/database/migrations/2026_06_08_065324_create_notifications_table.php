<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->string('type'); // appointment_created, appointment_updated, etc
        $table->unsignedBigInteger('appointment_id');
        $table->unsignedBigInteger('patient_id');
        $table->unsignedBigInteger('doctor_id');
        $table->string('patient_name');
        $table->string('doctor_name');
        $table->date('appointment_date');
        $table->time('appointment_time');
        $table->string('status');
        $table->text('message');
        $table->enum('channel', ['email', 'sms', 'system'])->default('system');
        $table->enum('sent_status', ['sent', 'failed', 'pending'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
