<?php

namespace App\Filament\Resources\BackupLogItemResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BackupLogItemResource;

class EditBackupLogItem extends EditRecord
{
    protected static string $resource = BackupLogItemResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
