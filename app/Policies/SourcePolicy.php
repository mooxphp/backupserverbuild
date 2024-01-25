<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Source;
use Illuminate\Auth\Access\HandlesAuthorization;

class SourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the source can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the source can view the model.
     */
    public function view(User $user, Source $model): bool
    {
        return true;
    }

    /**
     * Determine whether the source can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the source can update the model.
     */
    public function update(User $user, Source $model): bool
    {
        return true;
    }

    /**
     * Determine whether the source can delete the model.
     */
    public function delete(User $user, Source $model): bool
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
     * Determine whether the source can restore the model.
     */
    public function restore(User $user, Source $model): bool
    {
        return false;
    }

    /**
     * Determine whether the source can permanently delete the model.
     */
    public function forceDelete(User $user, Source $model): bool
    {
        return false;
    }
}
