<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Alumnos</h1>
    <a href="{{ route('alumnos.create') }}">Crear Alumno</a>
    <ul>
        @foreach ($alumnos as $alumno)
            <tr>
                <td>{{ $alumno->nombre }}</td>
                <td>{{ $alumno->correo }}</td>
                <td>{{ $alumno->codigo }}</td>
                <td>{{ $alumno->fecha_nacimiento }}</td>
                <td>{{ $alumno->sexo }}</td>
                <td>{{ $alumno->carrera }}</td>
            </tr>
        @endforeach
    </ul>
    
</body>
</html>