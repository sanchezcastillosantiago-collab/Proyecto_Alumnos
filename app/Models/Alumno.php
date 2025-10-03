<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';
    
    protected $fillable = [
        'nombre',
        'correo',
        'codigo',
        'fecha_nacimiento',
        'sexo',
        'carrera'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
}
