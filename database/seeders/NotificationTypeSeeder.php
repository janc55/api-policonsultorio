<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotificationType::insert([
            ['name' => 'Recordatorio de cita', 'description' => 'Recordatorio enviado al paciente', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cita confirmada', 'description' => 'Notificación de cita confirmada', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cita cancelada', 'description' => 'Notificación de cita cancelada', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pago recibido', 'description' => 'Notificación de pago registrado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
