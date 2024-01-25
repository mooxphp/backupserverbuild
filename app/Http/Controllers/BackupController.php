<?php

namespace App\Http\Controllers;

use App\Models\Backup;
use App\Models\Source;
use Illuminate\View\View;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BackupStoreRequest;
use App\Http\Requests\BackupUpdateRequest;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Backup::class);

        $search = $request->get('search', '');

        $backups = Backup::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.backups.index', compact('backups', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Backup::class);

        $sources = Source::pluck('name', 'id');
        $destinations = Destination::pluck('name', 'id');

        return view('app.backups.create', compact('sources', 'destinations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BackupStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Backup::class);

        $validated = $request->validated();

        $backup = Backup::create($validated);

        return redirect()
            ->route('backups.edit', $backup)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Backup $backup): View
    {
        $this->authorize('view', $backup);

        return view('app.backups.show', compact('backup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Backup $backup): View
    {
        $this->authorize('update', $backup);

        $sources = Source::pluck('name', 'id');
        $destinations = Destination::pluck('name', 'id');

        return view(
            'app.backups.edit',
            compact('backup', 'sources', 'destinations')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BackupUpdateRequest $request,
        Backup $backup
    ): RedirectResponse {
        $this->authorize('update', $backup);

        $validated = $request->validated();

        $backup->update($validated);

        return redirect()
            ->route('backups.edit', $backup)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Backup $backup): RedirectResponse
    {
        $this->authorize('delete', $backup);

        $backup->delete();

        return redirect()
            ->route('backups.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
