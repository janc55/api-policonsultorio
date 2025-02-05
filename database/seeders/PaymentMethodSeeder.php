<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::insert([
            ['name' => 'Efectivo', 'description' => 'Pago en efectivo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tarjeta de crédito', 'description' => 'Pago con tarjeta de crédito', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Transferencia bancaria', 'description' => 'Pago mediante transferencia bancaria', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
