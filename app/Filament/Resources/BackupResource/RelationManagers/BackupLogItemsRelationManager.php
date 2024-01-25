<?php

namespace App\Filament\Resources\BackupResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\RelationManagers\RelationManager;

class BackupLogItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'backupLogItems';

    protected static ?string $recordTitleAttribute = 'task';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('source_id')
                    ->rules(['exists:backup_server_sources,id'])
                    ->relationship('source', 'name')
                    ->searchable()
                    ->placeholder('Source')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('destination_id')
                    ->rules(['max:255'])
                    ->placeholder('Destination Id')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('task')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Task')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('level')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Level')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                RichEditor::make('message')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Message')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('source.name')->limit(50),
                Tables\Columns\TextColumn::make('backup.status')->limit(50),
                Tables\Columns\TextColumn::make('destination_id')->limit(50),
                Tables\Columns\TextColumn::make('task')->limit(50),
                Tables\Columns\TextColumn::make('level')->limit(50),
                Tables\Columns\TextColumn::make('message')->limit(50),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                SelectFilter::make('source_id')
                    ->multiple()
                    ->relationship('source', 'name'),

                SelectFilter::make('backup_id')
                    ->multiple()
                    ->relationship('backup', 'status'),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }
}
