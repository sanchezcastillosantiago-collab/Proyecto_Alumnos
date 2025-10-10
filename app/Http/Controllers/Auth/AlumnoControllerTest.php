<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('Muestra vista de edición de alumno', function () {
    $alumno = \App\Models\Alumno::factory()->create();
    $this->get(route('alumnos.edit', $alumno->id))
        ->assertStatus(200)
        ->assertSee('Editar Alumno')
        ->assertSee($alumno->nombre);
});