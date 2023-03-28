<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role->permissions->contains('name', 'role.access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->role->permissions->contains('name', 'role.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->permissions->contains('name', 'role.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->role->permissions->contains('name', 'role.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->role->permissions->contains('name', 'role.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        //
    }
}
