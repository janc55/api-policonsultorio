<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Obtener todos los doctores
    public function index()
    {
        return Doctor::with('specialty')->get();
    }

    // Crear un nuevo doctor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required|string|unique:doctors,license_number',
            'bio' => 'nullable|string',
        ]);

        $doctor = Doctor::create($validated);
        return response()->json(['message' => 'Doctor creado correctamente', 'doctor' => $doctor], 201);
    }

    // Mostrar un doctor específico
    public function show($id)
    {
        return Doctor::with('specialty')->findOrFail($id);
    }

    // Actualizar un doctor
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'specialty_id' => 'nullable|exists:specialties,id',
            'license_number' => 'nullable|string|unique:doctors,license_number,' . $doctor->id,
            'bio' => 'nullable|string',
        ]);

        $doctor->update($validated);
        return response()->json(['message' => 'Doctor actualizado correctamente', 'doctor' => $doctor]);
    }

    // Eliminar un doctor
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return response()->json(['message' => 'Doctor eliminado correctamente'], 204);
    }
}
