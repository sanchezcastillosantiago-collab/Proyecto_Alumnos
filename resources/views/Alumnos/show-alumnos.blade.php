<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Alumno</title>
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
        .card {
            background-color: #2a2a2a;
            border-color: #555;
        }
        .card-header {
            background-color: #333;
            border-color: #555;
            color: white;
        }
        .card-body {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Detalle del Alumno</h1>
        
        <div class="card">
            <div class="card-header">
                <h3>{{ $alumno->nombre }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> {{ $alumno->id }}</p>
                        <p><strong>Nombre:</strong> {{ $alumno->nombre }}</p>
                        <p><strong>Correo:</strong> {{ $alumno->correo }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Código:</strong> {{ $alumno->codigo }}</p>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $alumno->fecha_nacimiento }}</p>
                        <p><strong>Sexo:</strong> {{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p>
                        <p><strong>Carrera:</strong> {{ $alumno->carrera }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Volver a Lista</a>
            <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-warning">Editar</a>
            <form style="display:inline;" action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>