@extends('layouts.custom')

@section('title', '403 - Prohibido')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="display-4">403</h1>
                        <h2 class="h4 mb-3">No tienes el permiso necesario</h2>
                        <p class="text-muted mb-4">No puedes realizar esta acción. Si crees que esto es un error, contacta al administrador o vuelve a la página anterior.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                            <a href="{{ route('tareas.index') }}" class="btn btn-primary">Ver Tareas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
