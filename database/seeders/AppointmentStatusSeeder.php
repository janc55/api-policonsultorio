<?php

namespace Database\Seeders;

use App\Models\AppointmentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppointmentStatus::insert([
            ['name' => 'pending', 'description' => 'Cita pendiente', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'confirmed', 'description' => 'Cita confirmada', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cancelled', 'description' => 'Cita cancelada', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'completed', 'description' => 'Cita completada', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
