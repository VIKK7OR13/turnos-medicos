<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = ['especialidad_id', 'nombre', 'apellido', 'matricula'];

public function especialidad()
{
    return $this->belongsTo(Especialidad::class);
}

public function turnos()
{
    return $this->hasMany(Turno::class);
}
}
