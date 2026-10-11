<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Medico::with('especialidad')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'especialidad_id' => 'required|exists:especialidades,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'matricula' => 'required|string|max:50|unique:medicos,matricula',
        ]);

        $medico = Medico::create($datos);

        return response()->json($medico->load('especialidad'), 201);
    }

    public function show(Medico $medico): JsonResponse
    {
        return response()->json($medico->load('especialidad'));
    }

    public function update(Request $request, Medico $medico): JsonResponse
    {
        $datos = $request->validate([
            'especialidad_id' => 'required|exists:especialidades,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'matricula' => 'required|string|max:50|unique:medicos,matricula,' . $medico->id,
        ]);

        $medico->update($datos);

        return response()->json($medico->load('especialidad'));
    }

    public function destroy(Medico $medico): JsonResponse
    {
        $medico->delete();

        return response()->json(null, 204);
    }
}