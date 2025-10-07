<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
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
    public function store(Request $request)
    {
      

        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:alumnos,correo',
            'codigo' => 'required|string|unique:alumnos,codigo',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'carrera' => 'required|string|max:255',
        ]);
        $alumnos = new Alumno();
        $alumnos->nombre = $request->input('nombre');
        $alumnos->correo = $request->input('correo');
        $alumnos->codigo = $request->input('codigo');
        $alumnos->fecha_nacimiento = $request->input('fecha_nacimiento');
        $alumnos->sexo = $request->input('sexo');
        $alumnos->carrera = $request->input('carrera');
        $alumnos->save();
        
        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.show-alumno', compact('alumno'));
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
    public function update(Request $request, Alumno $alumno)
    {

        $alumno->nombre = $request->input('nombre');
        $alumno->correo = $request->input('correo');
        $alumno->codigo = $request->input('codigo');
        $alumno->fecha_nacimiento = $request->input('fecha_nacimiento');
        $alumno->sexo = $request->input('sexo');
        $alumno->carrera = $request->input('carrera');
        $alumno->save();
        
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
