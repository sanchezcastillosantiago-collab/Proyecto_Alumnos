@extends('layouts.custom')

@section('title','Editar Tarea')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Editar Tarea</h1>

        <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="overflow-hidden">
                <table class="min-w-full table-auto">
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <td class="px-4 py-3 w-1/3 text-sm font-medium text-gray-700">Nombre</td>
                            <td class="px-4 py-3">
                                <input type="text" name="nombre" value="{{ old('nombre', $tarea->nombre) }}" required autofocus class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nombre') border-red-600 ring-red-50 @enderror">
                                @error('nombre') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-4 py-3 text-sm font-medium text-gray-700">Descripción</td>
                            <td class="px-4 py-3">
                                <textarea name="descripcion" rows="4" class="w-full rounded-md border-gray-300 shadow-sm @error('descripcion') border-red-600 ring-red-50 @enderror">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                                @error('descripcion') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </td>
                        </tr>

                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-700">Fecha de entrega</td>
                            <td class="px-4 py-3">
                                <input type="date" name="fecha_entrega" value="{{ old('fecha_entrega', optional($tarea->fecha_entrega)->format('Y-m-d')) }}" class="w-full rounded-md border-gray-300 shadow-sm @error('fecha_entrega') border-red-600 ring-red-50 @enderror">
                                @error('fecha_entrega') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center gap-3 mt-4">
                <button type="submit" class="px-4 py-2 bg-gradient-to-br from-indigo-600 to-indigo-500 text-white rounded-md shadow hover:shadow-lg transform hover:-translate-y-0.5 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400">Guardar</button>
                <a href="{{ route('tareas.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-800 rounded-md shadow-sm hover:bg-gray-50 transition">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
