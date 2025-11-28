<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'secciones';

    protected $fillable = [
        'seccion',
        'aula',
    ];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'seccion_id');
    }
}
