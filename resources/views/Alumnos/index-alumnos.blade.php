
@extends('layouts.custom')

@section('title', 'Lista de Alumnos')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Lista de Alumnos</h1>
            <a href="{{ route('alumnos.create') }}" class="px-3 py-2 bg-gradient-to-br from-indigo-600 to-indigo-500 text-white rounded-md shadow hover:shadow-lg transform hover:-translate-y-0.5 transition">Crear Nuevo Alumno</a>
        </div>

        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Nac.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carrera</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($alumnos as $alumno)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $alumno->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('alumnos.show', $alumno->id) }}" class="text-indigo-600">{{ $alumno->nombre }}</a></td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $alumno->correo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $alumno->codigo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $alumno->fecha_nacimiento }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $alumno->carrera }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <a class="px-2 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600 transition shadow-sm" href="{{ route('alumnos.show', $alumno->id) }}">Ver</a>
                                <a class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-sm hover:bg-yellow-500 transition shadow-sm" href="{{ route('alumnos.edit', $alumno->id) }}">Editar</a>
                                <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700 transition shadow-sm">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
