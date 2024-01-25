<?php

namespace App\Filament\Resources\BackupResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BackupResource;
use App\Filament\Traits\HasDescendingOrder;

class ListBackups extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = BackupResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
