<?php

namespace App\Http\Controllers\Api;

use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackupResource;
use App\Http\Resources\BackupCollection;
use App\Http\Requests\BackupStoreRequest;
use App\Http\Requests\BackupUpdateRequest;

class BackupController extends Controller
{
    public function index(Request $request): BackupCollection
    {
        $this->authorize('view-any', Backup::class);

        $search = $request->get('search', '');

        $backups = Backup::search($search)
            ->latest()
            ->paginate();

        return new BackupCollection($backups);
    }

    public function store(BackupStoreRequest $request): BackupResource
    {
        $this->authorize('create', Backup::class);

        $validated = $request->validated();

        $backup = Backup::create($validated);

        return new BackupResource($backup);
    }

    public function show(Request $request, Backup $backup): BackupResource
    {
        $this->authorize('view', $backup);

        return new BackupResource($backup);
    }

    public function update(
        BackupUpdateRequest $request,
        Backup $backup
    ): BackupResource {
        $this->authorize('update', $backup);

        $validated = $request->validated();

        $backup->update($validated);

        return new BackupResource($backup);
    }

    public function destroy(Request $request, Backup $backup): Response
    {
        $this->authorize('delete', $backup);

        $backup->delete();

        return response()->noContent();
    }
}
