@extends('layouts.custom')

@section('title', 'Editar Sección')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h1 class="h4 mb-3">Editar Sección</h1>

                <form action="{{ route('secciones.update', $seccion->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="seccion" class="form-label">Sección</label>
                        <input type="text" id="seccion" name="seccion" value="{{ old('seccion', $seccion->seccion) }}" class="form-control @error('seccion') is-invalid @enderror" required />
                        @error('seccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="aula" class="form-label">Aula</label>
                        <input type="text" id="aula" name="aula" value="{{ old('aula', $seccion->aula) }}" class="form-control @error('aula') is-invalid @enderror" />
                        @error('aula') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <a href="{{ route('secciones.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
