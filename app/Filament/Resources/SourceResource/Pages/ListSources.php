<?php

namespace App\Filament\Resources\SourceResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SourceResource;
use App\Filament\Traits\HasDescendingOrder;

class ListSources extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = SourceResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
