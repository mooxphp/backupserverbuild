<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use App\Models\BackupLogItem;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\BackupLogItemResource\Pages;

class BackupLogItemResource extends Resource
{
    protected static ?string $model = BackupLogItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'task';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('source_id')
                        ->rules(['exists:backup_server_sources,id'])
                        ->required()
                        ->relationship('source', 'name')
                        ->searchable()
                        ->placeholder('Source')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('backup_id')
                        ->rules(['exists:backup_server_backups,id'])
                        ->required()
                        ->relationship('backup', 'status')
                        ->searchable()
                        ->placeholder('Backup')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('destination_id')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Destination Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('task')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Task')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('level')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Level')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('message')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Message')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('source.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('backup.status')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('destination_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('task')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('level')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('message')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('source_id')
                    ->relationship('source', 'name')
                    ->indicator('Source')
                    ->multiple()
                    ->label('Source'),

                SelectFilter::make('backup_id')
                    ->relationship('backup', 'status')
                    ->indicator('Backup')
                    ->multiple()
                    ->label('Backup'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBackupLogItems::route('/'),
            'create' => Pages\CreateBackupLogItem::route('/create'),
            'view' => Pages\ViewBackupLogItem::route('/{record}'),
            'edit' => Pages\EditBackupLogItem::route('/{record}/edit'),
        ];
    }
}
