<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seccion;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';
    
    protected $fillable = [
        'nombre',
        'correo',
        'codigo',
        'fecha_nacimiento',
        'sexo',
        'carrera',
        'seccion_id'
    ];
    //Esto se agrego para que se guerdaran los datos en la base de datos y no de error

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    /**
     * Relación: alumno pertenece a una sección (opcional)
     */
    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'seccion_id');
    }
}
