<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TurnoController extends Controller
{
    public function index(Request $request): JsonResponse
{
    $consulta = Turno::with(['paciente', 'medico.especialidad']);

    if ($request->filled('medico_id')) {
        $consulta->where('medico_id', $request->medico_id);
    }

    if ($request->filled('paciente_id')) {
        $consulta->where('paciente_id', $request->paciente_id);
    }

    if ($request->filled('fecha')) {
        $consulta->where('fecha', $request->fecha);
    }

    if ($request->filled('estado')) {
        $consulta->where('estado', $request->estado);
    }

  return response()->json($consulta->orderBy('fecha')->orderBy('hora')->paginate(10)->withQueryString());
}

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate($this->reglas($request));

        $turno = Turno::create($datos);

        return response()->json($turno->refresh()->load(['paciente', 'medico.especialidad']), 201);
    }

    public function show(Turno $turno): JsonResponse
    {
        return response()->json($turno->load(['paciente', 'medico.especialidad']));
    }

    public function update(Request $request, Turno $turno): JsonResponse
    {
        $datos = $request->validate($this->reglas($request, $turno));

        $turno->update($datos);

        return response()->json($turno->load(['paciente', 'medico.especialidad']));
    }

    public function destroy(Turno $turno): JsonResponse
    {
        $turno->delete();

        return response()->json(null, 204);
    }

    private function reglas(Request $request, ?Turno $turno = null): array
    {
        return [
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => [
                'required',
                'date_format:H:i',
                Rule::unique('turnos', 'hora')
                    ->where('medico_id', $request->medico_id)
                    ->where('fecha', $request->fecha)
                    ->ignore($turno?->id),
            ],
            'estado' => 'sometimes|in:pendiente,confirmado,cancelado',
            'motivo' => 'nullable|string|max:500',
        ];
    }
}