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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');  // Paciente
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');  // Doctor asignado
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');  // Especialidad seleccionada
            $table->date('schedule_date');  // Fecha de la cita
            $table->time('start_time');  // Hora de inicio
            $table->time('end_time');  // Hora de fin
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');  // Estado
            $table->text('notes')->nullable();  // Observaciones (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
