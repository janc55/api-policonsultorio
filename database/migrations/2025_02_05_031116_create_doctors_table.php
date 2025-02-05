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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Referencia al usuario (tabla users)
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');  // Referencia a la especialidad
            $table->string('license_number', 100)->unique();  // Número de licencia único
            $table->text('bio')->nullable();  // Biografía del doctor (opcional)
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
