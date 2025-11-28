<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Tarea;

uses(TestCase::class, RefreshDatabase::class);

test('non-admin cannot access alumno edit or delete routes', function () {
    $user = User::factory()->create(['role' => 'user', 'must_change_password' => false]);
    $alumno = Alumno::factory()->create();

    $this->actingAs($user)
        ->get(route('alumnos.edit', $alumno->id))
        ->assertStatus(403);

    $this->actingAs($user)
        ->delete(route('alumnos.destroy', $alumno->id))
        ->assertStatus(403);
});

test('admin can access alumno edit and delete routes', function () {
    $admin = User::factory()->create(['role' => 'admin', 'must_change_password' => false]);
    $alumno = Alumno::factory()->create();

    $this->actingAs($admin)
        ->get(route('alumnos.edit', $alumno->id))
        ->assertStatus(200);

    $this->actingAs($admin)
        ->delete(route('alumnos.destroy', $alumno->id))
        ->assertRedirect(route('alumnos.index'));
});

test('non-admin cannot update or delete tareas', function () {
    $user = User::factory()->create(['role' => 'user', 'must_change_password' => false]);
    $tarea = Tarea::factory()->create();

    $this->actingAs($user)
        ->get(route('tareas.edit', $tarea->id))
        ->assertStatus(403);

    $this->actingAs($user)
        ->delete(route('tareas.destroy', $tarea->id))
        ->assertStatus(403);
});

test('admin can update and delete tareas', function () {
    $admin = User::factory()->create(['role' => 'admin', 'must_change_password' => false]);
    $tarea = Tarea::factory()->create();

    $this->actingAs($admin)
        ->get(route('tareas.edit', $tarea->id))
        ->assertStatus(200);

    $this->actingAs($admin)
        ->delete(route('tareas.destroy', $tarea->id))
        ->assertRedirect(route('tareas.index'));
});
