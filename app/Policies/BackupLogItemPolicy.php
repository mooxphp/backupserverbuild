<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BackupLogItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class BackupLogItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the backupLogItem can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the backupLogItem can view the model.
     */
    public function view(User $user, BackupLogItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the backupLogItem can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the backupLogItem can update the model.
     */
    public function update(User $user, BackupLogItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the backupLogItem can delete the model.
     */
    public function delete(User $user, BackupLogItem $model): bool
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
     * Determine whether the backupLogItem can restore the model.
     */
    public function restore(User $user, BackupLogItem $model): bool
    {
        return false;
    }

    /**
     * Determine whether the backupLogItem can permanently delete the model.
     */
    public function forceDelete(User $user, BackupLogItem $model): bool
    {
        return false;
    }
}
