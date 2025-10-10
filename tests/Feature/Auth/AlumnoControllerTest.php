<?php


use App\Models\Alumno;


uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('Muestra vista de edición de alumno', function () {
    $alumno = \App\Models\Alumno::factory()->create();
    $this->get(route('alumnos.edit', $alumno->id))
        ->assertStatus(200)
        ->assertSee('Editar Alumno')
        ->assertSee($alumno->nombre);
});
test('Crea alumno correctamente', function () {
    $alumnoData = \App\Models\Alumno::factory()->make();
    
    $this->post(route('alumnos.store'), [
        'nombre' => $alumnoData->nombre,
        'correo' => $alumnoData->correo,
        'codigo' => $alumnoData->codigo,
        'fecha_nacimiento' => $alumnoData->fecha_nacimiento->format('Y-m-d'),
        'sexo' => $alumnoData->sexo,
        'carrera' => $alumnoData->carrera
    ])
        ->assertRedirect(route('alumnos.index'));
    
    $this->assertDatabaseHas('alumnos', [
        'nombre' => $alumnoData->nombre,
        'correo' => $alumnoData->correo,
        'codigo' => $alumnoData->codigo,
        'sexo' => $alumnoData->sexo,
        'carrera' => $alumnoData->carrera
    ]);
    
    $this->get(route('alumnos.index'))
        ->assertSee($alumnoData->nombre)
        ->assertSee($alumnoData->correo)
        ->assertSee($alumnoData->codigo);
});