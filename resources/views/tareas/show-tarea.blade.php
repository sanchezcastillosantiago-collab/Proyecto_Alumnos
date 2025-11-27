@extends('layouts.custom')

@section('title','Ver Tarea')

@section('content')
    <div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h1 class="h4 mb-2">{{ $tarea->nombre }}</h1>
            <p class="text-muted small mb-3">Creada por: {{ optional($tarea->user)->name ?? '-' }} | Fecha entrega: {{ optional($tarea->fecha_entrega)->format('Y-m-d') ?? '-' }}</p>
            <div class="mb-3">
                {!! nl2br(e($tarea->descripcion)) !!}
            </div>

            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Volver</a>
                @can('update', $tarea)
                <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning text-dark">Editar</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
