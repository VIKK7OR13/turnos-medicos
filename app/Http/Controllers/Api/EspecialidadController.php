<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Especialidad::all());
    }

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre',
        ]);

        $especialidad = Especialidad::create($datos);

        return response()->json($especialidad, 201);
    }

    public function show(Especialidad $especialidad): JsonResponse
    {
        return response()->json($especialidad);
    }

    public function update(Request $request, Especialidad $especialidad): JsonResponse
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre,' . $especialidad->id,
        ]);

        $especialidad->update($datos);

        return response()->json($especialidad);
    }

    public function destroy(Especialidad $especialidad): JsonResponse
    {
        $especialidad->delete();

        return response()->json(null, 204);
    }
}