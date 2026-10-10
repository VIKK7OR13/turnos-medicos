<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especialidad;
use App\Models\Medico;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicos = [
    ['Clínica Médica', 'Laura', 'Gómez', 'MP-1001'],
    ['Cardiología', 'Carlos', 'Fernández', 'MP-1002'],
    ['Pediatría', 'Marta', 'Rodríguez', 'MP-1003'],
    ['Traumatología', 'Julián', 'Pérez', 'MP-1004'],
    ['Ginecología', 'Sofía', 'López', 'MP-1005'],
    ['Dermatología', 'Andrés', 'Díaz', 'MP-1006'],
];

foreach ($medicos as [$especialidad, $nombre, $apellido, $matricula]) {
    Medico::create([
        'especialidad_id' => Especialidad::where('nombre', $especialidad)->first()->id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'matricula' => $matricula,
    ]);
}
    }
}
