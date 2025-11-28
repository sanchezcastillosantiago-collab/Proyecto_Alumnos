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
        // Apply policy mappings automatically for resource methods
        $this->authorizeResource(Tarea::class, 'tarea');

        // Solo las acciones que modifican requieren autenticación y must.change
        $this->middleware(['auth', 'must.change'])->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    // Protect edit/update/destroy with admin-or-404 so direct access shows 404 for non-admins
    protected static function booted()
    {
        // NOTE: we can't attach route middleware here statically; keep authorizeResource for policy checks.
    }

    public function index()
    {
    // Mostrar en orden cronológico (la primera creada aparece primero)
    // Cargar todas las tareas en una sola página (sin paginación)
    $tareas = Tarea::orderBy('created_at', 'asc')->get();
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
        try {
            \Log::info('Creating tarea', ['user' => Auth::id(), 'data' => $data]);
            Tarea::create($data);
        } catch (\Throwable $e) {
            \Log::error('Tarea create failed: ' . $e->getMessage());
            abort(500, 'Error al crear la tarea');
        }

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
