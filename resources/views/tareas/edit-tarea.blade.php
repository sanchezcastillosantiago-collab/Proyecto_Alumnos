@extends('layouts.custom')

@section('title','Editar Tarea')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Editar Tarea</h1>

        <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" class="container py-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre_tarea" class="form-label">Nombre</label>
                <input type="text" id="nombre_tarea" name="nombre" value="{{ old('nombre', $tarea->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" required autofocus />
                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion_tarea" class="form-label">Descripción</label>
                <textarea id="descripcion_tarea" name="descripcion" rows="4" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="fecha_entrega_tarea" class="form-label">Fecha de entrega</label>
                <input type="date" id="fecha_entrega_tarea" name="fecha_entrega" value="{{ old('fecha_entrega', optional($tarea->fecha_entrega)->format('Y-m-d')) }}" class="form-control @error('fecha_entrega') is-invalid @enderror" />
                @error('fecha_entrega') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
