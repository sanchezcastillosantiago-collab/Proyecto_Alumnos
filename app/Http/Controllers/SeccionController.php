<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\Alumno;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    public function __construct()
    {
        // show/index are public; modifications require auth + must.change and admin
        $this->middleware(['auth', 'must.change'])->only(['create', 'store', 'edit', 'update', 'destroy', 'attachAlumnos']);
        $this->middleware('admin.or404')->only(['create', 'store', 'edit', 'update', 'destroy', 'attachAlumnos']);
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
     * Display a listing of secciones.
     */
    public function index()
    {
        // Cargar todas las secciones en una sola página (sin paginación)
        $secciones = Seccion::orderBy('seccion')->get();
        return view('secciones.index-secciones', compact('secciones'));
    }

    /**
     * Show the form for creating a new seccion.
     */
    public function create()
    {
        return view('secciones.create-seccion');
    }

    /**
     * Store a newly created seccion in storage.
     */
    public function store(\App\Http\Requests\StoreSeccionRequest $request)
    {
        $data = $request->validated();
        Seccion::create($data);

        return redirect()->route('secciones.index')->with('success', 'Sección creada correctamente');
    }

    /**
     * Show the form for editing the specified seccion.
     */
    public function edit(Seccion $seccion)
    {
        return view('secciones.edit-seccion', compact('seccion'));
    }

    /**
     * Update the specified seccion in storage.
     */
    public function update(\App\Http\Requests\UpdateSeccionRequest $request, Seccion $seccion)
    {
        $data = $request->validated();
        $seccion->update($data);

        return redirect()->route('secciones.index')->with('success', 'Sección actualizada correctamente');
    }

    /**
     * Remove the specified seccion from storage.
     */
    public function destroy(Seccion $seccion)
    {
        $seccion->delete();
        return redirect()->route('secciones.index')->with('success', 'Sección eliminada correctamente');
    }

    /**
     * Attach one or more alumnos to the given seccion (many-to-many)
     */
    public function attachAlumnos(\App\Http\Requests\AttachAlumnosRequest $request, Seccion $seccion)
    {
        $data = $request->validated();

        $seccion->alumnosPivot()->syncWithoutDetaching($data['alumnos']);

        return redirect()->route('secciones.show', $seccion)->with('success', 'Alumnos inscritos correctamente.');
    }

    /**
     * Assign a random selection (or all) of available alumnos to this section.
     * Only accessible to admins (middleware enforces this).
     * Accepts optional `count` in the request to limit how many alumnos to attach.
     */
    public function assignRandom(Request $request, Seccion $seccion)
    {
        $request->validate([
            'count' => ['nullable','integer','min:1']
        ]);

        // IDs of alumnos not yet enrolled in this section
        $enrolledIds = $seccion->alumnosPivot()->pluck('id')->toArray();
        $available = Alumno::whereNotIn('id', $enrolledIds)->pluck('id')->toArray();

        if (empty($available)) {
            return redirect()->route('secciones.show', $seccion)->with('info', 'No hay alumnos disponibles para inscribir.');
        }

        // shuffle and take requested count or all
        shuffle($available);
        $count = $request->input('count');
        $selected = $count ? array_slice($available, 0, (int) $count) : $available;

        $seccion->alumnosPivot()->syncWithoutDetaching($selected);

        return redirect()->route('secciones.show', $seccion)->with('success', sprintf('Se han inscrito %d alumnos aleatoriamente.', count($selected)));
    }
}
