<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DestinationStoreRequest;
use App\Http\Requests\DestinationUpdateRequest;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Destination::class);

        $search = $request->get('search', '');

        $destinations = Destination::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.destinations.index',
            compact('destinations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Destination::class);

        return view('app.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DestinationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Destination::class);

        $validated = $request->validated();

        $destination = Destination::create($validated);

        return redirect()
            ->route('destinations.edit', $destination)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Destination $destination): View
    {
        $this->authorize('view', $destination);

        return view('app.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Destination $destination): View
    {
        $this->authorize('update', $destination);

        return view('app.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DestinationUpdateRequest $request,
        Destination $destination
    ): RedirectResponse {
        $this->authorize('update', $destination);

        $validated = $request->validated();

        $destination->update($validated);

        return redirect()
            ->route('destinations.edit', $destination)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Destination $destination
    ): RedirectResponse {
        $this->authorize('delete', $destination);

        $destination->delete();

        return redirect()
            ->route('destinations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
