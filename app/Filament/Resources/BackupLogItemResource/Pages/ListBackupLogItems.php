<?php

namespace App\Filament\Resources\BackupLogItemResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\BackupLogItemResource;

class ListBackupLogItems extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = BackupLogItemResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
