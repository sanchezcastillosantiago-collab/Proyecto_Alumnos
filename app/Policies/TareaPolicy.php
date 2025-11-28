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
     * Only the owner can update the tarea.
     */
    public function update(User $user, Tarea $tarea): bool
    {
        // Solo los administradores pueden actualizar tareas
        return $user->isAdmin();
    }

    /**
     * Only the owner can delete the tarea.
     */
    public function delete(User $user, Tarea $tarea): bool
    {
        // Solo los administradores pueden eliminar tareas
        return $user->isAdmin();
    }
}
