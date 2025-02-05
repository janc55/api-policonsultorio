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
        Schema::create('notification_types', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->string('name')->unique();  // Tipo de notificación
            $table->string('description')->nullable();  // Descripción opcional
            $table->timestamps();
        });

        // Modificar la tabla notifications para agregar este campo
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreignId('type_id')->constrained('notification_types')->onDelete('cascade');  // Nueva referencia
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });

        Schema::dropIfExists('notification_types');
    }
};
