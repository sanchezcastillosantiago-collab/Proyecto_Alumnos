<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;

class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $data['user_id'] = auth()->id();
        Tarea::create($data);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente');
    }

    public function show(Tarea $tarea)
    {
        return view('tareas.show-tarea', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        $this->authorize('update', $tarea);
        return view('tareas.edit-tarea', compact('tarea'));
    }

    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        $this->authorize('update', $tarea);
        $tarea->update($request->validated());
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy(Tarea $tarea)
    {
        $this->authorize('delete', $tarea);
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente');
    }
}
