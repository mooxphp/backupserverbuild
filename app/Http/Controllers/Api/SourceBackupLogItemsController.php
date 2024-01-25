<?php

namespace App\Http\Controllers\Api;

use App\Models\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackupLogItemResource;
use App\Http\Resources\BackupLogItemCollection;

class SourceBackupLogItemsController extends Controller
{
    public function index(
        Request $request,
        Source $source
    ): BackupLogItemCollection {
        $this->authorize('view', $source);

        $search = $request->get('search', '');

        $backupLogItems = $source
            ->backupLogItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new BackupLogItemCollection($backupLogItems);
    }

    public function store(
        Request $request,
        Source $source
    ): BackupLogItemResource {
        $this->authorize('create', BackupLogItem::class);

        $validated = $request->validate([
            'backup_id' => ['required', 'exists:backup_server_backups,id'],
            'destination_id' => ['required', 'max:255'],
            'task' => ['required', 'max:255', 'string'],
            'level' => ['required', 'max:255', 'string'],
            'message' => ['required', 'max:255', 'string'],
        ]);

        $backupLogItem = $source->backupLogItems()->create($validated);

        return new BackupLogItemResource($backupLogItem);
    }
}
