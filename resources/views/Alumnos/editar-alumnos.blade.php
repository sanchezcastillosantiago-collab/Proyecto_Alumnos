@extends('layouts.custom')

@section('title', 'Editar Alumno')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Editar Alumno</h1>

            <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST" class="container py-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $alumno->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre completo" required autofocus />
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo', $alumno->correo) }}" class="form-control @error('correo') is-invalid @enderror" placeholder="correo@ejemplo.com" required />
                    @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $alumno->codigo) }}" class="form-control @error('codigo') is-invalid @enderror" placeholder="CÓDIGO123" required />
                    @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required />
                    @error('fecha_nacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                        <option value="">Seleccionar...</option>
                        <option value="M" {{ old('sexo', $alumno->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('sexo', $alumno->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="carrera" class="form-label">Carrera</label>
                    <select id="carrera" name="carrera" class="form-select @error('carrera') is-invalid @enderror" required>
                        <option value="">Seleccionar carrera...</option>
                        <option value="Ingeniería en Sistemas" {{ old('carrera', $alumno->carrera) == 'Ingeniería en Sistemas' ? 'selected' : '' }}>Ingeniería en Sistemas</option>
                        <option value="Ingeniería Industrial" {{ old('carrera', $alumno->carrera) == 'Ingeniería Industrial' ? 'selected' : '' }}>Ingeniería Industrial</option>
                        <option value="Ingeniería Civil" {{ old('carrera', $alumno->carrera) == 'Ingeniería Civil' ? 'selected' : '' }}>Ingeniería Civil</option>
                        <option value="Arquitectura" {{ old('carrera', $alumno->carrera) == 'Arquitectura' ? 'selected' : '' }}>Arquitectura</option>
                        <option value="Medicina" {{ old('carrera', $alumno->carrera) == 'Medicina' ? 'selected' : '' }}>Medicina</option>
                        <option value="Derecho" {{ old('carrera', $alumno->carrera) == 'Derecho' ? 'selected' : '' }}>Derecho</option>
                        <option value="Administración de Empresas" {{ old('carrera', $alumno->carrera) == 'Administración de Empresas' ? 'selected' : '' }}>Administración de Empresas</option>
                        <option value="Contabilidad" {{ old('carrera', $alumno->carrera) == 'Contabilidad' ? 'selected' : '' }}>Contabilidad</option>
                        <option value="Psicología" {{ old('carrera', $alumno->carrera) == 'Psicología' ? 'selected' : '' }}>Psicología</option>
                        <option value="Educación" {{ old('carrera', $alumno->carrera) == 'Educación' ? 'selected' : '' }}>Educación</option>
                    </select>
                    @error('carrera') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Alumno</button>
                    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection