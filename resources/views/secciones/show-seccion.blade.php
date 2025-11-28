@extends('layouts.custom')

@section('title', 'Sección')

@section('content')
    <div class="container py-4">
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="h4">{{ $seccion->seccion }} @if($seccion->aula) <small class="text-muted">({{ $seccion->aula }})</small>@endif</h1>
                <p class="mb-0">Creada: {{ $seccion->created_at->format('Y-m-d') }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Alumnos inscritos</div>
                    <div class="card-body">
                        @if($seccion->alumnosPivot->isEmpty())
                            <p>No hay alumnos inscritos.</p>
                        @else
                            <ul class="list-group">
                                @foreach($seccion->alumnosPivot as $alumno)
                                    <li class="list-group-item">{{ $alumno->nombre }} — {{ $alumno->correo }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Inscribir alumnos</div>
                    <div class="card-body">
                        @can('is-admin')
                            <div class="mb-3">
                                <form action="{{ route('secciones.attach.alumnos', $seccion) }}" method="POST" class="mb-3">
                                    @csrf
                                    <label for="alumnos" class="form-label">Seleccionar alumnos</label>
                                    <select id="alumnos" name="alumnos[]" class="form-select" multiple size="8">
                                        @foreach($availableAlumnos as $alumno)
                                            <option value="{{ $alumno->id }}">{{ $alumno->nombre }} — {{ $alumno->correo }}</option>
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <button class="btn btn-primary" type="submit">Inscribir seleccionados</button>
                                    </div>
                                </form>
                            </div>

                            <div class="mb-3">
                                <form action="{{ route('secciones.assign.random', $seccion) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <label for="count" class="form-label mb-0">Inscribir aleatoriamente</label>
                                    <input type="number" name="count" id="count" min="1" placeholder="Número (vacío = todos)" class="form-control" style="width:140px;" />
                                    <button class="btn btn-outline-primary" type="submit">Ejecutar</button>
                                </form>
                                <small class="text-muted">Si dejas vacío, se inscriben todos los alumnos disponibles.</small>
                            </div>
                        @else
                            <div class="alert alert-secondary">Solo los administradores pueden inscribir alumnos a esta sección.</div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
