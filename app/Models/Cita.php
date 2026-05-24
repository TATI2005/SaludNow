<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Cita extends Model {
    protected $connection = 'mongodb';
    protected $collection = 'citas';

    protected $fillable = [
        'usuario_registrador', 
        'nombre_paciente', 
        'cedula', 
        'edad', 
        'fecha_nacimiento', 
        'eps', 
        'telefono', 
        'direccion', 
        'especialidad', 
        'motivo_especifico', 
        'descripcion',
        'medico_id',
        'nombre_medico',
        'hora_cita',
        'fecha_asignada',
        'mes_asignado',
        'sede',
        'estado'
    ];
}