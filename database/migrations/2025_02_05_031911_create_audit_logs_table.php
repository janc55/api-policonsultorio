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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Usuario que realizó el cambio
            $table->string('event');  // Tipo de evento (ej. creación, modificación, eliminación)
            $table->string('model');  // Modelo afectado (ej. Appointment, User)
            $table->bigInteger('model_id');  // ID del modelo afectado
            $table->text('changes')->nullable();  // Detalles de los cambios realizados
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};
