<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, User $model): bool
    {
        return true;
    }

    /**
     * Only the user themself can update their profile.
     */
    public function update(User $user, User $model): bool
    {
        // Admins can update any user; others only their own profile
        return $user->isAdmin() || $user->id === $model->id;
    }

    /**
     * Only the user themself can delete their profile.
     */
    public function delete(User $user, User $model): bool
    {
        // Admins can delete any user; others only their own profile
        return $user->isAdmin() || $user->id === $model->id;
    }
}
