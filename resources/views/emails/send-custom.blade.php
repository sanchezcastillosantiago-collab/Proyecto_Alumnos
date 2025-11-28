@extends('layouts.custom')

@section('title', 'Enviar correo personalizado')

@section('content')
    <div class="container py-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="h4 mb-3">Enviar correo personalizado</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('emails.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="to" class="form-label">Para (email)</label>
                    <input type="email" id="to" name="to" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Asunto</label>
                    <input type="text" id="subject" name="subject" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Contenido</label>
                    <textarea id="body" name="body" rows="6" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
@endsection
