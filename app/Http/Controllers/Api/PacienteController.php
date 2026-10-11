<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Paciente::all());
    }

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'dni' => 'required|string|max:20|unique:pacientes,dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'telefono' => 'nullable|string|max:30',
            'obra_social' => 'nullable|string|max:255',
        ]);

        $paciente = Paciente::create($datos);

        return response()->json($paciente, 201);
    }

    public function show(Paciente $paciente): JsonResponse
    {
        return response()->json($paciente);
    }

    public function update(Request $request, Paciente $paciente): JsonResponse
    {
        $datos = $request->validate([
            'dni' => 'required|string|max:20|unique:pacientes,dni,' . $paciente->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'telefono' => 'nullable|string|max:30',
            'obra_social' => 'nullable|string|max:255',
        ]);

        $paciente->update($datos);

        return response()->json($paciente);
    }

    public function destroy(Paciente $paciente): JsonResponse
    {
        $paciente->delete();

        return response()->json(null, 204);
    }
}