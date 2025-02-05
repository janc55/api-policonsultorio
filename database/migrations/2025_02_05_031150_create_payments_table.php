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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');  // Referencia a la cita
            $table->decimal('amount', 10, 2);  // Monto del pago
            $table->string('payment_method');  // Método de pago (tarjeta, efectivo, etc.)
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');  // Estado del pago
            $table->string('transaction_id')->nullable();  // ID de transacción (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
