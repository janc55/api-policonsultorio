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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');  // Referencia al doctor
            $table->enum('day_of_week', [
                'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
            ]);  // Día de la semana
            $table->time('start_time');  // Hora de inicio del turno
            $table->time('end_time');  // Hora de finalización del turno
            $table->timestamps();  // Campos automáticos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
