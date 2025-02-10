<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Console;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConsolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_console');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Console $console): bool
    {
        return $user->can('view_console');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_console');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Console $console): bool
    {
        return $user->can('update_console');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Console $console): bool
    {
        return $user->can('delete_console');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_console');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Console $console): bool
    {
        return $user->can('force_delete_console');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_console');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Console $console): bool
    {
        return $user->can('restore_console');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_console');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Console $console): bool
    {
        return $user->can('replicate_console');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_console');
    }
}
