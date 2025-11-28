@extends('layouts.custom')

@section('title', 'Archivos')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Archivos</h1>
            @auth
                <a href="{{ route('files.create') }}" class="btn btn-primary">Subir archivos</a>
            @endauth
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Tamaño</th>
                            <th>Subido por</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $f)
                            <tr>
                                <td>{{ $f->id }}</td>
                                <td>{{ $f->original_name }}</td>
                                <td>
                                    @php
                                        $bytes = $f->size ?? 0;
                                        if ($bytes >= 1048576) {
                                            $sizeStr = round($bytes / 1048576, 2) . ' MB';
                                        } elseif ($bytes >= 1024) {
                                            $sizeStr = round($bytes / 1024, 2) . ' KB';
                                        } else {
                                            $sizeStr = $bytes . ' B';
                                        }
                                    @endphp
                                    {{ $sizeStr }}
                                </td>
                                <td>{{ optional($f->user)->name ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('files.download', $f->id) }}" class="btn btn-sm btn-primary">Descargar</a>

                                        @can('is-admin')
                                            <form action="{{ route('files.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Eliminar archivo?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>

                                            <form action="{{ route('files.replace', $f->id) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
                                                @csrf
                                                <input type="file" name="file" class="form-control form-control-sm" style="width:160px;" />
                                                <button class="btn btn-sm btn-warning">Reemplazar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No hay archivos subidos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
