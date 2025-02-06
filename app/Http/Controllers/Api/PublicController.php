<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class PublicController extends Controller
{
     // Obtener todas las especialidades disponibles
     public function getSpecialties()
     {
         return response()->json(Specialty::all(['id', 'name']));
     }
 
     // Obtener los doctores por especialidad
     public function getDoctorsBySpecialty(Request $request)
     {
         $validated = $request->validate([
             'specialty_id' => 'required|exists:specialties,id',
         ]);
 
         $doctors = Doctor::where('specialty_id', $validated['specialty_id'])
                          ->with('user:id,name')
                          ->get(['id', 'user_id']);
 
         return response()->json($doctors);
     }
}
