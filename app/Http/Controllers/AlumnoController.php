<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function __construct()
    {
        // Solo administradores pueden crear/editar/eliminar alumnos; devolver 404 si no
        $this->middleware('admin.or404')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::all();
        return view('alumnos.index-alumnos', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('alumnos.create-alumno');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\StoreAlumnoRequest $request)
    {
        $data = $request->validated();
        $alumnos = Alumno::create($data);

        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.show-alumnos', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.editar-alumnos', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\UpdateAlumnoRequest $request, Alumno $alumno)
    {
        $data = $request->validated();
        $alumno->update($data);

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente');
    }
}
