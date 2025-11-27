@extends('layouts.custom')

@section('title', 'Detalle del Alumno')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">{{ $alumno->nombre }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm"><strong>ID:</strong> {{ $alumno->id }}</p>
                    <p class="text-sm"><strong>Nombre:</strong> {{ $alumno->nombre }}</p>
                    <p class="text-sm"><strong>Correo:</strong> {{ $alumno->correo }}</p>
                </div>
                <div>
                    <p class="text-sm"><strong>Código:</strong> {{ $alumno->codigo }}</p>
                    <p class="text-sm"><strong>Fecha de Nacimiento:</strong> {{ $alumno->fecha_nacimiento }}</p>
                    <p class="text-sm"><strong>Sexo:</strong> {{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p>
                    <p class="text-sm"><strong>Carrera:</strong> {{ $alumno->carrera }}</p>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3">
                <a href="{{ route('alumnos.index') }}" class="px-3 py-2 bg-gray-200 text-gray-800 rounded-md">Volver a Lista</a>
                <a href="{{ route('alumnos.edit', $alumno->id) }}" class="px-3 py-2 bg-yellow-400 text-gray-900 rounded-md">Editar</a>
                <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded-md">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

@endsection