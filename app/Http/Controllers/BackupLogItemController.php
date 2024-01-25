<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Backup;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\BackupLogItem;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BackupLogItemStoreRequest;
use App\Http\Requests\BackupLogItemUpdateRequest;

class BackupLogItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', BackupLogItem::class);

        $search = $request->get('search', '');

        $backupLogItems = BackupLogItem::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.backup_log_items.index',
            compact('backupLogItems', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', BackupLogItem::class);

        $sources = Source::pluck('name', 'id');
        $backups = Backup::pluck('status', 'id');

        return view(
            'app.backup_log_items.create',
            compact('sources', 'backups')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BackupLogItemStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', BackupLogItem::class);

        $validated = $request->validated();

        $backupLogItem = BackupLogItem::create($validated);

        return redirect()
            ->route('backup-log-items.edit', $backupLogItem)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, BackupLogItem $backupLogItem): View
    {
        $this->authorize('view', $backupLogItem);

        return view('app.backup_log_items.show', compact('backupLogItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BackupLogItem $backupLogItem): View
    {
        $this->authorize('update', $backupLogItem);

        $sources = Source::pluck('name', 'id');
        $backups = Backup::pluck('status', 'id');

        return view(
            'app.backup_log_items.edit',
            compact('backupLogItem', 'sources', 'backups')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BackupLogItemUpdateRequest $request,
        BackupLogItem $backupLogItem
    ): RedirectResponse {
        $this->authorize('update', $backupLogItem);

        $validated = $request->validated();

        $backupLogItem->update($validated);

        return redirect()
            ->route('backup-log-items.edit', $backupLogItem)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        BackupLogItem $backupLogItem
    ): RedirectResponse {
        $this->authorize('delete', $backupLogItem);

        $backupLogItem->delete();

        return redirect()
            ->route('backup-log-items.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
