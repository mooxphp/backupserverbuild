<?php

namespace App\Http\Controllers\Api;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\DestinationCollection;
use App\Http\Requests\DestinationStoreRequest;
use App\Http\Requests\DestinationUpdateRequest;

class DestinationController extends Controller
{
    public function index(Request $request): DestinationCollection
    {
        $this->authorize('view-any', Destination::class);

        $search = $request->get('search', '');

        $destinations = Destination::search($search)
            ->latest()
            ->paginate();

        return new DestinationCollection($destinations);
    }

    public function store(DestinationStoreRequest $request): DestinationResource
    {
        $this->authorize('create', Destination::class);

        $validated = $request->validated();

        $destination = Destination::create($validated);

        return new DestinationResource($destination);
    }

    public function show(
        Request $request,
        Destination $destination
    ): DestinationResource {
        $this->authorize('view', $destination);

        return new DestinationResource($destination);
    }

    public function update(
        DestinationUpdateRequest $request,
        Destination $destination
    ): DestinationResource {
        $this->authorize('update', $destination);

        $validated = $request->validated();

        $destination->update($validated);

        return new DestinationResource($destination);
    }

    public function destroy(
        Request $request,
        Destination $destination
    ): Response {
        $this->authorize('delete', $destination);

        $destination->delete();

        return response()->noContent();
    }
}
