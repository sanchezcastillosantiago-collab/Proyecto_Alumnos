<?php

namespace App\Policies;

use App\Models\Tarea;
use App\Models\User;

class TareaPolicy
{
    /**
     * Determine whether any user (including guest) can view any tareas.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the tarea.
     */
    public function view(?User $user, Tarea $tarea): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create tareas.
     */
    public function create(User $user): bool
    {
        // Cualquier usuario autenticado puede crear una tarea
        return $user !== null;
    }

    /**
     * Only the owner can update the tarea.
     */
    public function update(User $user, Tarea $tarea): bool
    {
        // Solo el dueño (creator) puede actualizar la tarea
        return $user->id === $tarea->user_id;
    }

    /**
     * Only the owner can delete the tarea.
     */
    public function delete(User $user, Tarea $tarea): bool
    {
        // Solo el dueño (creator) puede eliminar la tarea
        return $user->id === $tarea->user_id;
    }
}
