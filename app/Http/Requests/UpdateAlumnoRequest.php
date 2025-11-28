<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlumnoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $alumnoId = $this->route('alumno') ? $this->route('alumno')->id : null;

        return [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:alumnos,correo,' . $alumnoId,
            'codigo' => 'required|string|unique:alumnos,codigo,' . $alumnoId,
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
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'sexo.required' => 'El sexo es obligatorio.',
            'carrera.required' => 'La carrera es obligatoria.',
        ];
    }
}
