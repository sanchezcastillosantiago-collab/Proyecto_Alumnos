<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Crear Alumno</h1>
    <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo"><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
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