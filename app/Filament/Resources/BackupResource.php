<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Backup;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\BackupResource\Pages;

class BackupResource extends Resource
{
    protected static ?string $model = Backup::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'status';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('status')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

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

                    Select::make('destination_id')
                        ->rules(['exists:backup_server_destinations,id'])
                        ->required()
                        ->relationship('destination', 'name')
                        ->searchable()
                        ->placeholder('Destination')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('disk_name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Disk Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('path')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Path')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('size_in_kb')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Size In Kb')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('real_size_in_kb')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Real Size In Kb')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('completed_at')
                        ->rules(['date'])
                        ->nullable()
                        ->placeholder('Completed At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('rsync_summary')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Rsync Summary')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('rsync_time_in_seconds')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Rsync Time In Seconds')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('rsync_current_transfer_speed')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Rsync Current Transfer Speed')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make(
                        'rsync_average_transfer_speed_in_MB_per_second'
                    )
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder(
                            'Rsync Average Transfer Speed In Mb Per Second'
                        )
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
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('source.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('destination.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('disk_name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('path')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('size_in_kb')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('real_size_in_kb')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('completed_at')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('rsync_summary')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('rsync_time_in_seconds')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('rsync_current_transfer_speed')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make(
                    'rsync_average_transfer_speed_in_MB_per_second'
                )
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('source_id')
                    ->relationship('source', 'name')
                    ->indicator('Source')
                    ->multiple()
                    ->label('Source'),

                SelectFilter::make('destination_id')
                    ->relationship('destination', 'name')
                    ->indicator('Destination')
                    ->multiple()
                    ->label('Destination'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            BackupResource\RelationManagers\BackupLogItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBackups::route('/'),
            'create' => Pages\CreateBackup::route('/create'),
            'view' => Pages\ViewBackup::route('/{record}'),
            'edit' => Pages\EditBackup::route('/{record}/edit'),
        ];
    }
}
