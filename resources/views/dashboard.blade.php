@extends('layouts.custom')

@section('title', __('Dashboard'))
@guest
    <script>window.location = "{{ route('login') }}";</script>
@endguest

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="bg-white rounded-lg shadow p-6 text-center mx-4 max-w-3xl w-full">
            <h1 class="text-3xl sm:text-4xl font-semibold">Bienvenido{{ auth()->check() ? ', ' . auth()->user()->name : '' }}.</h1>
            <p class="mt-2 text-gray-600">Accede al menú lateral para navegar por el panel.</p>
        </div>
    </div>

@endsection
