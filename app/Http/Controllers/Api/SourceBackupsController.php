<?php

namespace App\Http\Controllers\Api;

use App\Models\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackupResource;
use App\Http\Resources\BackupCollection;

class SourceBackupsController extends Controller
{
    public function index(Request $request, Source $source): BackupCollection
    {
        $this->authorize('view', $source);

        $search = $request->get('search', '');

        $backups = $source
            ->backups()
            ->search($search)
            ->latest()
            ->paginate();

        return new BackupCollection($backups);
    }

    public function store(Request $request, Source $source): BackupResource
    {
        $this->authorize('create', Backup::class);

        $validated = $request->validate([
            'status' => ['required', 'max:255', 'string'],
            'destination_id' => [
                'required',
                'exists:backup_server_destinations,id',
            ],
            'disk_name' => ['required', 'max:255', 'string'],
            'path' => ['nullable', 'max:255', 'string'],
            'size_in_kb' => ['nullable', 'max:255'],
            'real_size_in_kb' => ['nullable', 'max:255'],
            'completed_at' => ['nullable', 'date'],
            'rsync_summary' => ['nullable', 'max:255', 'string'],
            'rsync_time_in_seconds' => ['nullable', 'max:255'],
            'rsync_current_transfer_speed' => ['nullable', 'max:255', 'string'],
            'rsync_average_transfer_speed_in_MB_per_second' => [
                'nullable',
                'max:255',
                'string',
            ],
        ]);

        $backup = $source->backups()->create($validated);

        return new BackupResource($backup);
    }
}
