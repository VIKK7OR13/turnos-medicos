<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EspecialidadController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\TurnoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('especialidades', EspecialidadController::class)
    ->parameters(['especialidades' => 'especialidad']);

Route::apiResource('medicos', MedicoController::class);

Route::apiResource('pacientes', PacienteController::class);

Route::apiResource('turnos', TurnoController::class);