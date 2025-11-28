<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\Alumno;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('must.change');
        // actions that modify enrollment should be admin-only and return 404 otherwise
        $this->middleware('admin.or404')->only(['attachAlumnos']);
    }

    /**
     * Display the specified section and its alumnos.
     */
    public function show(Seccion $seccion)
    {
        // alumnos not yet inscritos
    $enrolledIds = $seccion->alumnosPivot()->pluck('id')->toArray();
        $availableAlumnos = Alumno::whereNotIn('id', $enrolledIds)->get();

        return view('secciones.show-seccion', compact('seccion', 'availableAlumnos'));
    }

    /**
     * Attach one or more alumnos to the given seccion (many-to-many)
     */
    public function attachAlumnos(Request $request, Seccion $seccion)
    {
        $data = $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*' => 'exists:alumnos,id',
        ]);

        $seccion->alumnosPivot()->syncWithoutDetaching($data['alumnos']);

        return redirect()->route('secciones.show', $seccion)->with('success', 'Alumnos inscritos correctamente.');
    }
}
