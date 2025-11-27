<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTareaRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la tarea es obligatorio.',
            'fecha_entrega.date' => 'La fecha de entrega debe ser una fecha válida.',
        ];
    }
}
