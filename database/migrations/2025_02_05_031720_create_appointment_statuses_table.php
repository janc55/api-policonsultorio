<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointment_statuses', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->string('name')->unique();  // Nombre del estado (ej. pendiente, confirmada)
            $table->string('description')->nullable();  // Descripción opcional
            $table->timestamps();
        });

        // Modificar la tabla appointments para usar esta referencia
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('status');  // Elimina el campo ENUM anterior
            $table->foreignId('status_id')->constrained('appointment_statuses')->onDelete('cascade');  // Referencia al nuevo campo
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');  // Restaura el campo ENUM
        });

        Schema::dropIfExists('appointment_statuses');
    }
};
