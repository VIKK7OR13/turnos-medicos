<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
    'Clínica Médica',
    'Cardiología',
    'Pediatría',
    'Traumatología',
    'Ginecología',
    'Dermatología',
];

foreach ($especialidades as $nombre) {
    Especialidad::create(['nombre' => $nombre]);
}
    }
}
