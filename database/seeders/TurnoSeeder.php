<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Turno;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $turnos = [
    ['30111222', 'MP-1002', 1, '09:00', 'pendiente', 'Control de presión'],
    ['32444555', 'MP-1003', 1, '10:30', 'confirmado', 'Control anual'],
    ['28777888', 'MP-1004', 2, '11:00', 'pendiente', 'Dolor de rodilla'],
    ['40222333', 'MP-1005', 3, '15:00', 'pendiente', 'Control ginecológico'],
    ['35666999', 'MP-1001', 3, '16:30', 'cancelado', null],
    ['30111222', 'MP-1006', 5, '09:30', 'confirmado', 'Revisión de lunares'],
];

foreach ($turnos as [$dni, $matricula, $dias, $hora, $estado, $motivo]) {
    Turno::create([
        'paciente_id' => Paciente::where('dni', $dni)->first()->id,
        'medico_id' => Medico::where('matricula', $matricula)->first()->id,
        'fecha' => now()->addDays($dias)->toDateString(),
        'hora' => $hora,
        'estado' => $estado,
        'motivo' => $motivo,
    ]);
}
    }
}
