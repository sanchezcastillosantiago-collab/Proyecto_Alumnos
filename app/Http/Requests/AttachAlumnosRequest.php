<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachAlumnosRequest extends FormRequest
{
    public function authorize()
    {
        // Only admins can attach alumnos to secciones (controller also protects with middleware)
        return $this->user() && method_exists($this->user(), 'isAdmin') && $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'alumnos' => 'required|array|min:1',
            'alumnos.*' => 'required|integer|exists:alumnos,id',
        ];
    }

    public function messages()
    {
        return [
            'alumnos.required' => 'Selecciona al menos un alumno.',
            'alumnos.*.exists' => 'Uno o más alumnos seleccionados no existen.',
        ];
    }
}
