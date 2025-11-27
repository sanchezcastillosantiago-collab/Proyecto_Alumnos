@extends('layouts.custom')

@section('title','Ver Tarea')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-2">{{ $tarea->nombre }}</h1>
        <p class="text-sm text-gray-600 mb-4">Creada por: {{ optional($tarea->user)->name ?? '-' }} | Fecha entrega: {{ optional($tarea->fecha_entrega)->format('Y-m-d') ?? '-' }}</p>
        <div class="prose">
            {!! nl2br(e($tarea->descripcion)) !!}
        </div>

        <div class="mt-6 flex items-center gap-3">
            <a href="{{ route('tareas.index') }}" class="px-3 py-2 bg-gray-200 text-gray-800 rounded-md">Volver</a>
            @can('update', $tarea)
            <a href="{{ route('tareas.edit', $tarea->id) }}" class="px-3 py-2 bg-yellow-400 text-gray-900 rounded-md">Editar</a>
            @endcan
        </div>
    </div>
</div>
@endsection
