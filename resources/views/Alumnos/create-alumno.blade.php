@extends('layouts.custom')

@section('title', 'Crear Alumno')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Crear Alumno</h1>

            @if (session('success'))
                <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('alumnos.store') }}" method="POST" class="container py-4">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre completo" required autofocus />
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo') }}" class="form-control @error('correo') is-invalid @enderror" placeholder="correo@ejemplo.com" required />
                    @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" inputmode="numeric" pattern="\d*" id="codigo" name="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror" placeholder="123456" required />
                    @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required />
                    @error('fecha_nacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                        <option value="">Seleccionar...</option>
                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="carrera" class="form-label">Carrera</label>
                    <select id="carrera" name="carrera" class="form-select @error('carrera') is-invalid @enderror" required>
                        <option value="">Seleccionar carrera...</option>
                        <option value="Ingeniería en Sistemas">Ingeniería en Sistemas</option>
                        <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                        <option value="Ingeniería Civil">Ingeniería Civil</option>
                        <option value="Arquitectura">Arquitectura</option>
                        <option value="Medicina">Medicina</option>
                        <option value="Derecho">Derecho</option>
                        <option value="Administración de Empresas">Administración de Empresas</option>
                        <option value="Contabilidad">Contabilidad</option>
                        <option value="Psicología">Psicología</option>
                        <option value="Educación">Educación</option>
                    </select>
                    @error('carrera') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="seccion_id" class="form-label">Sección</label>
                    <select id="seccion_id" name="seccion_id" class="form-select @error('seccion_id') is-invalid @enderror">
                        <option value="">Sin sección</option>
                        @foreach($secciones as $seccion)
                            <option value="{{ $seccion->id }}" {{ old('seccion_id') == $seccion->id ? 'selected' : '' }}>{{ $seccion->seccion }} @if($seccion->aula) - {{ $seccion->aula }}@endif</option>
                        @endforeach
                    </select>
                    @error('seccion_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Alumno</button>
                    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection