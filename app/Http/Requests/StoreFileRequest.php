<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'files' => 'required|array|max:20',
            'files.*' => 'file|max:51200', // max 50MB each
        ];
    }

    public function messages()
    {
        return [
            'files.required' => 'Seleccione al menos un archivo.',
            'files.*.file' => 'Cada elemento debe ser un archivo válido.',
            'files.*.max' => 'El archivo supera el tamaño máximo permitido (50MB).',
        ];
    }
}
