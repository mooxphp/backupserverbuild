<?php

namespace App\Http\Controllers\Api;

use App\Models\Backup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackupLogItemResource;
use App\Http\Resources\BackupLogItemCollection;

class BackupBackupLogItemsController extends Controller
{
    public function index(
        Request $request,
        Backup $backup
    ): BackupLogItemCollection {
        $this->authorize('view', $backup);

        $search = $request->get('search', '');

        $backupLogItems = $backup
            ->backupLogItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new BackupLogItemCollection($backupLogItems);
    }

    public function store(
        Request $request,
        Backup $backup
    ): BackupLogItemResource {
        $this->authorize('create', BackupLogItem::class);

        $validated = $request->validate([
            'source_id' => ['required', 'exists:backup_server_sources,id'],
            'destination_id' => ['required', 'max:255'],
            'task' => ['required', 'max:255', 'string'],
            'level' => ['required', 'max:255', 'string'],
            'message' => ['required', 'max:255', 'string'],
        ]);

        $backupLogItem = $backup->backupLogItems()->create($validated);

        return new BackupLogItemResource($backupLogItem);
    }
}
