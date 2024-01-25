<?php

namespace App\Filament\Resources\BackupLogItemResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\BackupLogItemResource;

class ViewBackupLogItem extends ViewRecord
{
    protected static string $resource = BackupLogItemResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
