<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Backup;
use Illuminate\Auth\Access\HandlesAuthorization;

class BackupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the backup can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the backup can view the model.
     */
    public function view(User $user, Backup $model): bool
    {
        return true;
    }

    /**
     * Determine whether the backup can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the backup can update the model.
     */
    public function update(User $user, Backup $model): bool
    {
        return true;
    }

    /**
     * Determine whether the backup can delete the model.
     */
    public function delete(User $user, Backup $model): bool
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
     * Determine whether the backup can restore the model.
     */
    public function restore(User $user, Backup $model): bool
    {
        return false;
    }

    /**
     * Determine whether the backup can permanently delete the model.
     */
    public function forceDelete(User $user, Backup $model): bool
    {
        return false;
    }
}
