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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->string('nip', 20)->unique();           // nomor induk pegawai
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->string('specialization');              // Umum, Gigi, Anak, dll
            $table->string('license_number', 50)->unique(); // nomor STR dokter
            $table->integer('experience_years');           // lama pengalaman
            $table->text('education');                     // riwayat pendidikan
            $table->decimal('consultation_fee', 10, 2);   // biaya konsultasi
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
