<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = [
    ['30111222', 'Martín', 'Suárez', '1985-03-14', '3511234567', 'OSDE'],
    ['32444555', 'Valeria', 'Romero', '1990-07-22', '3519876543', 'Swiss Medical'],
    ['28777888', 'Diego', 'Torres', '1982-11-05', null, null],
    ['40222333', 'Camila', 'Acosta', '1998-01-30', '3515551234', 'PAMI'],
    ['35666999', 'Lucía', 'Herrera', '1993-09-17', '3514447788', 'Galeno'],
];

foreach ($pacientes as [$dni, $nombre, $apellido, $fechaNacimiento, $telefono, $obraSocial]) {
    Paciente::create([
        'dni' => $dni,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'fecha_nacimiento' => $fechaNacimiento,
        'telefono' => $telefono,
        'obra_social' => $obraSocial,
    ]);
}
    }
}
