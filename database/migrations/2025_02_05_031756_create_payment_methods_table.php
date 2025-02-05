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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->string('name')->unique();  // Nombre del método (ej. tarjeta, efectivo)
            $table->string('description')->nullable();  // Descripción opcional
            $table->timestamps();
        });

        // Modificar la tabla payments para usar esta referencia
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('payment_method');  // Elimina el campo anterior
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');  // Nueva referencia
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
            $table->string('payment_method');  // Restaura el campo string anterior
        });

        Schema::dropIfExists('payment_methods');
    }
};
