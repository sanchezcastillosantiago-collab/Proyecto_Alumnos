@extends('layouts.custom')

@section('title', 'Secciones')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Secciones</h1>
            @can('is-admin')
                <a href="{{ route('secciones.create') }}" class="btn btn-primary">Crear Sección</a>
            @endcan
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Sección</th>
                            <th>Aula</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($secciones as $seccion)
                            <tr>
                                <td>{{ $seccion->id }}</td>
                                <td><a href="{{ route('secciones.show', $seccion->id) }}">{{ $seccion->seccion }}</a></td>
                                <td>{{ $seccion->aula ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('secciones.show', $seccion->id) }}" class="btn btn-sm btn-primary">Ver</a>
                                        @can('is-admin')
                                            <a href="{{ route('secciones.edit', $seccion->id) }}" class="btn btn-sm btn-warning text-dark">Editar</a>
                                            <form action="{{ route('secciones.destroy', $seccion->id) }}" method="POST" onsubmit="return confirm('¿Eliminar sección?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay secciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination removed: show all secciones on a single page like Alumnos -->
    </div>
@endsection
