<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\View\View;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SourceStoreRequest;
use App\Http\Requests\SourceUpdateRequest;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Source::class);

        $search = $request->get('search', '');

        $sources = Source::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.sources.index', compact('sources', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Source::class);

        $destinations = Destination::pluck('name', 'id');

        return view('app.sources.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SourceStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Source::class);

        $validated = $request->validated();
        $validated['pre_backup_commands'] = json_decode(
            $validated['pre_backup_commands'],
            true
        );

        $validated['post_backup_commands'] = json_decode(
            $validated['post_backup_commands'],
            true
        );

        $validated['includes'] = json_decode($validated['includes'], true);

        $validated['excludes'] = json_decode($validated['excludes'], true);

        $source = Source::create($validated);

        return redirect()
            ->route('sources.edit', $source)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Source $source): View
    {
        $this->authorize('view', $source);

        return view('app.sources.show', compact('source'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Source $source): View
    {
        $this->authorize('update', $source);

        $destinations = Destination::pluck('name', 'id');

        return view('app.sources.edit', compact('source', 'destinations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SourceUpdateRequest $request,
        Source $source
    ): RedirectResponse {
        $this->authorize('update', $source);

        $validated = $request->validated();
        $validated['pre_backup_commands'] = json_decode(
            $validated['pre_backup_commands'],
            true
        );

        $validated['post_backup_commands'] = json_decode(
            $validated['post_backup_commands'],
            true
        );

        $validated['includes'] = json_decode($validated['includes'], true);

        $validated['excludes'] = json_decode($validated['excludes'], true);

        $source->update($validated);

        return redirect()
            ->route('sources.edit', $source)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Source $source): RedirectResponse
    {
        $this->authorize('delete', $source);

        $source->delete();

        return redirect()
            ->route('sources.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
