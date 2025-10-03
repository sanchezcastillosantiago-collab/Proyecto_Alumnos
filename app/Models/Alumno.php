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
    //Esto se agrego para que se guerdaran los datos en la base de datos y no de error

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
}
