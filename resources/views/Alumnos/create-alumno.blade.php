<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background-color: black;
            color: white;
        }
        h1 {
            color: white;
        }
        a {
            color: #007bff;
        }
        a:hover {
            color: #0056b3;
        }
        label {
            color: white;
        }
        .form-control, .form-select {
            background-color: #2a2a2a;
            border-color: #555;
            color: white;
        }
        .form-control:focus, .form-select:focus {
            background-color: #2a2a2a;
            border-color: #007bff;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Crear Alumno</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('alumnos.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required value="{{ old('nombre') }}">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo" required value="{{ old('correo') }}">
            </div>

            <div class="mb-3">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required value="{{ old('codigo') }}">
            </div>

            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required value="{{ old('fecha_nacimiento') }}">
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo:</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="">Seleccionar...</option>
                    <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera:</label>
                <select class="form-select" id="carrera" name="carrera" required>
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
            </div>

            <button type="submit" class="btn btn-primary">Guardar Alumno</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>