<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlumnoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // cambiar si se desea verificar permisos
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:alumnos,correo',
            // codigo must contain only digits
            'codigo' => ['required', 'regex:/^[0-9]+$/', 'unique:alumnos,codigo'],
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'carrera' => 'required|string|max:255',
            'seccion_id' => 'nullable|exists:secciones,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo debe ser una dirección válida.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.regex' => 'El código debe contener sólo números (0-9).',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'sexo.required' => 'El sexo es obligatorio.',
            'carrera.required' => 'La carrera es obligatoria.',
        ];
    }
}
