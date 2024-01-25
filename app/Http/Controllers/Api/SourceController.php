<?php

namespace App\Http\Controllers\Api;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SourceResource;
use App\Http\Resources\SourceCollection;
use App\Http\Requests\SourceStoreRequest;
use App\Http\Requests\SourceUpdateRequest;

class SourceController extends Controller
{
    public function index(Request $request): SourceCollection
    {
        $this->authorize('view-any', Source::class);

        $search = $request->get('search', '');

        $sources = Source::search($search)
            ->latest()
            ->paginate();

        return new SourceCollection($sources);
    }

    public function store(SourceStoreRequest $request): SourceResource
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

        return new SourceResource($source);
    }

    public function show(Request $request, Source $source): SourceResource
    {
        $this->authorize('view', $source);

        return new SourceResource($source);
    }

    public function update(
        SourceUpdateRequest $request,
        Source $source
    ): SourceResource {
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

        return new SourceResource($source);
    }

    public function destroy(Request $request, Source $source): Response
    {
        $this->authorize('delete', $source);

        $source->delete();

        return response()->noContent();
    }
}
