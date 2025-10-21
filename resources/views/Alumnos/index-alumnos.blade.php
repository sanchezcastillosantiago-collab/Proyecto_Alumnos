
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de los Alumnos</title>
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
        .table-dark {
            --bs-table-bg: #2a2a2a;
            --bs-table-color: white;
        }
        .table-dark th {
            background-color: #333;
        }
        .table-dark td {
            background-color: #2a2a2a;
        }
        .table-hover tbody tr:hover {
            background-color: #404040 !important;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Lista de Alumnos</h1>
        
        <x-encabezado>
            Lista de todos los alumnos registrados
        </x-encabezado>
        
        <div class="mb-3">
            <a href="{{ route('alumnos.create') }}" class="btn btn-primary">Crear Nuevo Alumno</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Código</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td><a href="{{ route('alumnos.show', $alumno->id) }}" style="color: #007bff;">{{ $alumno->nombre }}</a></td>
                        <td>{{ $alumno->correo }}</td>
                        <td>{{ $alumno->codigo }}</td>
                        <td>{{ $alumno->fecha_nacimiento }}</td>
                        <td>{{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                        <td>{{ $alumno->carrera }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('alumnos.show', $alumno->id) }}">Ver</a>
                            <a class="btn btn-warning btn-sm" href="{{ route('alumnos.edit', $alumno->id) }}">Editar</a>
                            <form style="display:inline;" action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
