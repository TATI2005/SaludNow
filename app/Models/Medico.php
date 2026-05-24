<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class Medico extends Model {
    protected $connection = 'mongodb';
    protected $collection = 'medicos';
    protected $fillable = [
        'nombre', 
        'email', 
        'password', 
        'documento_identidad', // C.C. o Registro Médico
        'telefono', 
        'edad',
        'sede',
        'especialidad', 
        'horarios',
        'total_pendientes',
        'total_atendidos',
        'total_inasistencias'
    ];
}