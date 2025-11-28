<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Apply policy mappings automatically for resource methods
        $this->authorizeResource(Tarea::class, 'tarea');
        // Además, devolver 404 a usuarios autenticados que no sean admin cuando intenten editar/eliminar
        $this->middleware('admin.or404')->only(['edit', 'update', 'destroy']);
    }

    // Protect edit/update/destroy with admin-or-404 so direct access shows 404 for non-admins
    protected static function booted()
    {
        // NOTE: we can't attach route middleware here statically; keep authorizeResource for policy checks.
    }

    public function index()
    {
        $tareas = Tarea::latest()->paginate(12);
        return view('tareas.index-tareas', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create-tarea');
    }

    public function store(StoreTareaRequest $request)
    {
        $data = $request->validated();
    $data['user_id'] = Auth::id();
        Tarea::create($data);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente');
    }

    public function show(Tarea $tarea)
    {
        return view('tareas.show-tarea', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        return view('tareas.edit-tarea', compact('tarea'));
    }

    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        $tarea->update($request->validated());
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente');
    }
}
