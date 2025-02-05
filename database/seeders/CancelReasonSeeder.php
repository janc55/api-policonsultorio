<?php

namespace Database\Seeders;

use App\Models\CancelReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CancelReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CancelReason::insert([
            ['reason' => 'Paciente no se presentó', 'created_at' => now(), 'updated_at' => now()],
            ['reason' => 'Cancelado por el doctor', 'created_at' => now(), 'updated_at' => now()],
            ['reason' => 'Cita reprogramada', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
