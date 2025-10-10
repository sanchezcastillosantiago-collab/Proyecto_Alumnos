<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Alumnos</title>
</head>
<body>
    <h1>Alumnos</h1>
    
    <ul>
        <li>
            <a href="{{ route('alumnos.create') }}">Crear Alumno</a>
        </li>
    </ul>
    <table border="1" > 
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Código</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($alumnos as $alumno)
        <tr>
            <td>
                {{ $alumno->id }}
            </td>
            <td>
                <a href="{{ route('alumnos.show', $alumno->id) }}">{{ $alumno->nombre }}</a>
            </td>
            <td>
                {{ $alumno->correo }}
            </td>
            <td>
                {{ $alumno->codigo }}
            </td>
            <td>
                {{ $alumno->fecha_nacimiento }}
            </td>
            <td>
                {{ $alumno->sexo }}
            </td>
            <td>
                {{ $alumno->carrera }}
            </td>
            <td>
                <a href="{{ route('alumnos.edit', $alumno->id) }}">Editar</a>
            </td>
        </tr>
        <td>
            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form> 
        @endforeach
    
        </tbody>
</body>
</html>