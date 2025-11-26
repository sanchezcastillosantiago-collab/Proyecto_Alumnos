<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'fecha_entrega',
    ];

    protected $casts = [
        'fecha_entrega' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
