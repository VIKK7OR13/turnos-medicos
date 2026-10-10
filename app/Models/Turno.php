<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
   protected $fillable = ['paciente_id', 'medico_id', 'fecha', 'hora', 'estado', 'motivo'];

public function paciente()
{
    return $this->belongsTo(Paciente::class);
}

public function medico()
{
    return $this->belongsTo(Medico::class);
}
}
