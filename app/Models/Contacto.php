<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Contacto extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'contactos';
    protected $fillable = ['nombre', 'email', 'mensaje', 'leido'];
}