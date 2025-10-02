<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            //$table->timestamps();
            $table->string('nombre');
            $table->string('correo')->unique();
            $table->string('codigo')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('sexo');
            $table->enum('carrera', ['Ingeniería en Sistemas', 'Ingeniería Industrial', 'Ingeniería Civil', 'Arquitectura', 'Medicina', 'Derecho', 'Administración de Empresas', 'Contabilidad', 'Psicología', 'Educación']);
            $table->save();
            return redirect()->route('alumnos.index');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
