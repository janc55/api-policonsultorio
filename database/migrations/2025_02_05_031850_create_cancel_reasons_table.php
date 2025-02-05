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
        Schema::create('cancel_reasons', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->string('reason')->unique();  // Razón de cancelación
            $table->timestamps();
        });

        // Modificar la tabla appointments para agregar esta referencia
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('cancel_reason_id')->nullable()->constrained('cancel_reasons')->onDelete('cascade');  // Referencia opcional
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['cancel_reason_id']);
            $table->dropColumn('cancel_reason_id');
        });

        Schema::dropIfExists('cancel_reasons');
    }
};
