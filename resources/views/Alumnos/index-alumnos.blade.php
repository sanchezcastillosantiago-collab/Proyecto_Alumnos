
@extends('layouts.custom')

@section('title', 'Lista de Alumnos')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Lista de Alumnos</h1>
            <a href="{{ route('alumnos.create') }}" class="btn btn-primary">Crear Nuevo Alumno</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Código</th>
                                <th>Fecha Nac.</th>
                                <th>Sexo</th>
                                <th>Carrera</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->id }}</td>
                                <td><a href="{{ route('alumnos.show', $alumno->id) }}">{{ $alumno->nombre }}</a></td>
                                <td>{{ $alumno->correo }}</td>
                                <td>{{ $alumno->codigo }}</td>
                                <td>{{ $alumno->fecha_nacimiento }}</td>
                                <td>{{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                                <td>{{ $alumno->carrera }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class="btn btn-sm btn-primary" href="{{ route('alumnos.show', $alumno->id) }}">Ver</a>
                                        <a class="btn btn-sm btn-warning text-dark" href="{{ route('alumnos.edit', $alumno->id) }}">Editar</a>
                                        <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
