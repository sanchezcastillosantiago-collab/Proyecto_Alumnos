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

            <form action="{{ route('alumnos.store') }}" method="POST" novalidate>
                @csrf

                <div class="overflow-hidden">
                    <table class="min-w-full table-auto">
                        <tbody class="bg-white">
                            <tr class="border-b">
                                <td class="px-4 py-3 w-1/3 text-sm font-medium text-gray-700">Nombre</td>
                                <td class="px-4 py-3">
                                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required autofocus placeholder="Nombre completo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nombre') border-red-600 ring-red-50 @enderror">
                                    @error('nombre') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </td>
                            </tr>

                            <tr class="border-b">
                                <td class="px-4 py-3 text-sm font-medium text-gray-700">Correo</td>
                                <td class="px-4 py-3">
                                    <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required placeholder="correo@ejemplo.com" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('correo') border-red-600 ring-red-50 @enderror">
                                    @error('correo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </td>
                            </tr>

                            <tr class="border-b">
                                <td class="px-4 py-3 text-sm font-medium text-gray-700">Código</td>
                                <td class="px-4 py-3">
                                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" required placeholder="CÓDIGO123" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('codigo') border-red-600 ring-red-50 @enderror">
                                    @error('codigo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </td>
                            </tr>

                            <tr class="border-b">
                                <td class="px-4 py-3 text-sm font-medium text-gray-700">Fecha de Nacimiento</td>
                                <td class="px-4 py-3">
                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('fecha_nacimiento') border-red-600 ring-red-50 @enderror">
                                    @error('fecha_nacimiento') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </td>
                            </tr>

                            <tr class="border-b">
                                <td class="px-4 py-3 text-sm font-medium text-gray-700">Sexo</td>
                                <td class="px-4 py-3">
                                    <select name="sexo" id="sexo" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('sexo') border-red-600 ring-red-50 @enderror">
                                        <option value="">Seleccionar...</option>
                                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                    @error('sexo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-700">Carrera</td>
                                <td class="px-4 py-3">
                                    <select name="carrera" id="carrera" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('carrera') border-red-600 ring-red-50 @enderror">
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
                                    @error('carrera') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center gap-3 mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-br from-indigo-600 to-indigo-500 text-white rounded-md shadow hover:shadow-lg transform hover:-translate-y-0.5 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400">Guardar Alumno</button>
                    <a href="{{ route('alumnos.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-800 rounded-md shadow-sm hover:bg-gray-50 transition">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection