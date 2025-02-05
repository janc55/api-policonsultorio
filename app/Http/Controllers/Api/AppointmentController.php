<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Obtener todas las citas (index)
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor', 'specialty', 'status'])->get();
        return response()->json($appointments);
    }

    // Crear una nueva cita (store)
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'patient_id' => 'required|exists:users,id',
                'doctor_id' => 'required|exists:doctors,id',
                'specialty_id' => 'required|exists:specialties,id',
                'schedule_date' => 'required|date',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i:s|after:start_time',
                'status_id' => 'required|exists:appointment_statuses,id',
                'notes' => 'nullable|string'
            ]);

            $appointment = Appointment::create($validated);

            return response()->json(['message' => 'Cita creada correctamente', 'appointment' => $appointment], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Mostrar una cita específica (show)
    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'specialty', 'status'])->findOrFail($id);
        return response()->json($appointment);
    }

    // Actualizar una cita (update)
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'schedule_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i:s',
            'end_time' => 'nullable|date_format:H:i:s|after:start_time',
            'status_id' => 'nullable|exists:appointment_statuses,id',
            'notes' => 'nullable|string'
        ]);

        $appointment->update($validated);
        return response()->json(['message' => 'Cita actualizada correctamente', 'appointment' => $appointment]);
    }

    // Eliminar una cita (destroy)
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['message' => 'Cita eliminada correctamente'], 204);
    }
}
