@extends('layouts.custom')

@section('title', 'Tareas')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Tareas</h1>
            @auth
                <a href="{{ route('tareas.create') }}" class="btn btn-primary">Crear Tarea</a>
            @endauth
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Fecha Entrega</th>
                            <th>Creado por</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tareas as $tarea)
                            <tr>
                                <td>{{ $tarea->id }}</td>
                                <td>{{ $tarea->nombre }}</td>
                                <td>{{ optional($tarea->fecha_entrega)->format('Y-m-d') }}</td>
                                <td>{{ optional($tarea->user)->name ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('tareas.show', $tarea->id) }}" class="btn btn-sm btn-primary">Ver</a>
                                        @can('update', $tarea)
                                        <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-sm btn-warning text-dark">Editar</a>
                                        @endcan
                                        @can('delete', $tarea)
                                        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" onsubmit="return confirm('¿Eliminar tarea?');">
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
                                <td colspan="5">No hay tareas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination removed: show all tareas on a single page like Alumnos -->
    </div>
@endsection
