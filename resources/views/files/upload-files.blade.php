@extends('layouts.custom')

@section('title', 'Subir Archivos')

@section('content')
    <div class="container py-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="h4 mb-3">Subir Archivos</h1>

            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="files" class="form-label">Seleccione uno o varios archivos</label>
                    <input type="file" id="files" name="files[]" multiple class="form-control @error('files') is-invalid @enderror" />
                    @error('files') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary">Subir</button>
                <a href="{{ route('files.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
