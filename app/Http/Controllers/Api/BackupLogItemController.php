<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\BackupLogItem;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackupLogItemResource;
use App\Http\Resources\BackupLogItemCollection;
use App\Http\Requests\BackupLogItemStoreRequest;
use App\Http\Requests\BackupLogItemUpdateRequest;

class BackupLogItemController extends Controller
{
    public function index(Request $request): BackupLogItemCollection
    {
        $this->authorize('view-any', BackupLogItem::class);

        $search = $request->get('search', '');

        $backupLogItems = BackupLogItem::search($search)
            ->latest()
            ->paginate();

        return new BackupLogItemCollection($backupLogItems);
    }

    public function store(
        BackupLogItemStoreRequest $request
    ): BackupLogItemResource {
        $this->authorize('create', BackupLogItem::class);

        $validated = $request->validated();

        $backupLogItem = BackupLogItem::create($validated);

        return new BackupLogItemResource($backupLogItem);
    }

    public function show(
        Request $request,
        BackupLogItem $backupLogItem
    ): BackupLogItemResource {
        $this->authorize('view', $backupLogItem);

        return new BackupLogItemResource($backupLogItem);
    }

    public function update(
        BackupLogItemUpdateRequest $request,
        BackupLogItem $backupLogItem
    ): BackupLogItemResource {
        $this->authorize('update', $backupLogItem);

        $validated = $request->validated();

        $backupLogItem->update($validated);

        return new BackupLogItemResource($backupLogItem);
    }

    public function destroy(
        Request $request,
        BackupLogItem $backupLogItem
    ): Response {
        $this->authorize('delete', $backupLogItem);

        $backupLogItem->delete();

        return response()->noContent();
    }
}
