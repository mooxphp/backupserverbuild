<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Auth\Access\HandlesAuthorization;

class DestinationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the destination can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the destination can view the model.
     */
    public function view(User $user, Destination $model): bool
    {
        return true;
    }

    /**
     * Determine whether the destination can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the destination can update the model.
     */
    public function update(User $user, Destination $model): bool
    {
        return true;
    }

    /**
     * Determine whether the destination can delete the model.
     */
    public function delete(User $user, Destination $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the destination can restore the model.
     */
    public function restore(User $user, Destination $model): bool
    {
        return false;
    }

    /**
     * Determine whether the destination can permanently delete the model.
     */
    public function forceDelete(User $user, Destination $model): bool
    {
        return false;
    }
}
