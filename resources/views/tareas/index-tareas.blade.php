@extends('layouts.custom')

@section('title', 'Tareas')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Tareas</h1>
            <a href="{{ route('tareas.create') }}" class="px-3 py-2 bg-gradient-to-br from-indigo-600 to-indigo-500 text-white rounded-md shadow hover:shadow-lg transform hover:-translate-y-0.5 transition">Crear Tarea</a>
        </div>

        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Entrega</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado por</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tareas as $tarea)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tarea->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tarea->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ optional($tarea->fecha_entrega)->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ optional($tarea->user)->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('tareas.show', $tarea->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600 transition shadow-sm">Ver</a>
                                    @can('update', $tarea)
                                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-sm hover:bg-yellow-500 transition shadow-sm">Editar</a>
                                    @endcan
                                    @can('delete', $tarea)
                                    <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" onsubmit="return confirm('¿Eliminar tarea?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700 transition shadow-sm">Eliminar</button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-4" colspan="5">No hay tareas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tareas->links() }}
        </div>
    </div>
@endsection
