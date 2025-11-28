@extends('layouts.custom')

@section('title', 'Detalle del Alumno')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h1 class="h4 mb-3">{{ $alumno->nombre }}</h1>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1"><strong>ID:</strong> {{ $alumno->id }}</p>
                        <p class="mb-1"><strong>Nombre:</strong> {{ $alumno->nombre }}</p>
                        <p class="mb-1"><strong>Correo:</strong> {{ $alumno->correo }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1"><strong>Código:</strong> {{ $alumno->codigo }}</p>
                        <p class="mb-1"><strong>Fecha de Nacimiento:</strong> {{ $alumno->fecha_nacimiento }}</p>
                        <p class="mb-1"><strong>Sexo:</strong> {{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p>
                        <p class="mb-1"><strong>Carrera:</strong> {{ $alumno->carrera }}</p>
                        <p class="mb-1"><strong>Sección:</strong> {{ optional($alumno->seccion)->seccion ?? '-' }} {{ optional($alumno->seccion)->aula ? '(' . optional($alumno->seccion)->aula . ')' : '' }}</p>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Volver a Lista</a>
                        @can('is-admin')
                            <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-warning text-dark">Editar</a>
                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endcan
                </div>
            </div>
        </div>
    </div>

@endsection