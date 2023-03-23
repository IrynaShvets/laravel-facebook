<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_DEVELOPER = 'developer';
   
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $user = User::find(auth()->user()->id);
        if (asset($user->role()->first()->name)) {
            $role = $user->role()->first()->name;
            if($role === self::ROLE_ADMIN || $role === self::ROLE_MODERATOR || $role === self::ROLE_DEVELOPER){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        $user = User::find(auth()->user()->id);
        if (asset($user->role()->first()->name)) {
            $role = $user->role()->first()->name;
            if($role === self::ROLE_ADMIN || $role === self::ROLE_DEVELOPER){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        $user = User::find(auth()->user()->id);
        if (asset($user->role()->first()->name)) {
            $role = $user->role()->first()->name;
            if($role === self::ROLE_ADMIN){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
