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
                        <form action="{{ route('secciones.attach.alumnos', $seccion) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="alumnos" class="form-label">Seleccionar alumnos</label>
                                <select id="alumnos" name="alumnos[]" class="form-select" multiple size="8">
                                    @foreach($availableAlumnos as $alumno)
                                        <option value="{{ $alumno->id }}">{{ $alumno->nombre }} — {{ $alumno->correo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-primary" type="submit">Inscribir seleccionados</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
