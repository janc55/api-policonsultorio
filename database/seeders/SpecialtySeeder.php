<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialty::insert([
            ['name' => 'Cardiología', 'description' => 'Especialidad médica que trata enfermedades del corazón', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dermatología', 'description' => 'Especialidad que se ocupa del tratamiento de la piel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pediatría', 'description' => 'Atención médica para niños', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oftalmología', 'description' => 'Especialidad médica que trata enfermedades de los ojos', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
