<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSlot;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return Schedule::with('doctor')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
        ]);

        $schedule = Schedule::create($validated);
        return response()->json(['message' => 'Horario creado correctamente', 'schedule' => $schedule], 201);
    }

    public function show($id)
    {
        return Schedule::with('doctor')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'day_of_week' => 'nullable|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'nullable|date_format:H:i:s',
            'end_time' => 'nullable|date_format:H:i:s|after:start_time',
        ]);

        $schedule->update($validated);
        return response()->json(['message' => 'Horario actualizado correctamente', 'schedule' => $schedule]);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return response()->json(['message' => 'Horario eliminado correctamente'], 204);
    }
    public function generateSlots(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
        ]);

        AppointmentSlot::generateSlotsForDate($validated['doctor_id'], $validated['date']);

        return response()->json(['message' => 'Slots generados correctamente']);
    }
    
}
