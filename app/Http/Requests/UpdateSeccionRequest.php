<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeccionRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && method_exists($this->user(), 'isAdmin') && $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'seccion' => 'required|string|max:255',
            'aula' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'seccion.required' => 'El nombre de la sección es obligatorio.',
        ];
    }
}
