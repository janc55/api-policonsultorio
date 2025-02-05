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
        Schema::create('appointment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');  // Referencia a la cita
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Usuario que realiza el cambio
            $table->string('action');  // Acción realizada (creación, modificación, cancelación, etc.)
            $table->text('notes')->nullable();  // Descripción de la acción (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_logs');
    }
};
