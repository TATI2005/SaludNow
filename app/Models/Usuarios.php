<?php

namespace App\Models; // Nombre de la carpeta donde esta este archivo.

use MongoDB\Laravel\Auth\User as Authenticatable; // Esta usando mongo y laravel para ser autentico.

class Usuarios extends Authenticatable // 'class' de clase de modelo, 'extends', extendido y 'Authenticatable' autenticado en el sistema.
{
    protected $connection = 'mongodb'; // '$connection' esta variable hace a la conexion de la base de datos -> 'protected' se usa dentro del modelo, clases que se hereden 'public' apto para todo y 'private' solo se puede utilizar en esta clase y no en las otras.
    protected $collection = 'Usuarios'; // '$collection' esta  variable es el nombre de la colleccion.

    protected $fillable = [ // '$fillable' sirve para guardar datos.
        'nombre',
        'email',
        'password'
    ];

    protected $hidden = [  // '$hidden' sirve para ocultar datos.
        'password',
        'remember_token'  // Recordar al usuario, sin hacer otra vez el formulario.
    ];
}

