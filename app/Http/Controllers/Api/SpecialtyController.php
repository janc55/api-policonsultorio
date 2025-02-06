<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        return Specialty::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:specialties,name',
            'description' => 'nullable|string',
        ]);

        $specialty = Specialty::create($validated);
        return response()->json(['message' => 'Especialidad creada correctamente', 'specialty' => $specialty], 201);
    }

    public function show($id)
    {
        return Specialty::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $specialty = Specialty::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable|string',
        ]);

        $specialty->update($validated);
        return response()->json(['message' => 'Especialidad actualizada correctamente', 'specialty' => $specialty]);
    }

    public function destroy($id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();
        return response()->json(['message' => 'Especialidad eliminada correctamente'], 204);
    }
}
