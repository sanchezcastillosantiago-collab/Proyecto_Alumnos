<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Crear Alumno</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="color: green; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('alumnos.store') }}" method="POST" >
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required value="{{ old('nombre') }}"><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required value="{{ old('correo') }}"><br>

        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required value="{{ old('codigo') }}"><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required value="{{ old('fecha_nacimiento') }}"><br>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="">Seleccionar...</option>
            <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
        </select><br>

        <label for="carrera">Carrera:</label>
        <select id="carrera" name="carrera" required>
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
        </select><br>

        <button type="submit">Guardar Alumno</button>
    </form>
</body>
</html>