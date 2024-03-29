<?php

namespace App\Filament\Resources\DestinationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\RelationManagers\RelationManager;

class SourcesRelationManager extends RelationManager
{
    protected static string $relationship = 'sources';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('status')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Status')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('healthy')
                    ->rules(['max:255'])
                    ->placeholder('Healthy')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('name')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('host')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Host')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('ssh_user')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Ssh User')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('ssh_port')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Ssh Port')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('ssh_private_key_file')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Ssh Private Key File')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('cron_expression')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Cron Expression')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                KeyValue::make('pre_backup_commands')->columnSpan([
                    'default' => 12,
                    'md' => 12,
                    'lg' => 12,
                ]),

                KeyValue::make('post_backup_commands')->columnSpan([
                    'default' => 12,
                    'md' => 12,
                    'lg' => 12,
                ]),

                KeyValue::make('includes')->columnSpan([
                    'default' => 12,
                    'md' => 12,
                    'lg' => 12,
                ]),

                KeyValue::make('excludes')->columnSpan([
                    'default' => 12,
                    'md' => 12,
                    'lg' => 12,
                ]),

                TextInput::make('cleanup_strategy_class')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Cleanup Strategy Class')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('keep_all_backups_for_days')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Keep All Backups For Days')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('keep_daily_backups_for_days')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Keep Daily Backups For Days')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('keep_weekly_backups_for_weeks')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Keep Weekly Backups For Weeks')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('keep_monthly_backups_for_months')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Keep Monthly Backups For Months')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('keep_yearly_backups_for_years')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Keep Yearly Backups For Years')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make(
                    'delete_oldest_backups_when_using_more_megabytes_than'
                )
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder(
                        'Delete Oldest Backups When Using More Megabytes Than'
                    )
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('healthy_maximum_backup_age_in_days')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Healthy Maximum Backup Age In Days')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('healthy_maximum_storage_in_mb')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Healthy Maximum Storage In Mb')
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
                Tables\Columns\TextColumn::make('status')->limit(50),
                Tables\Columns\TextColumn::make('healthy')->limit(50),
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('host')->limit(50),
                Tables\Columns\TextColumn::make('ssh_user')->limit(50),
                Tables\Columns\TextColumn::make('ssh_port'),
                Tables\Columns\TextColumn::make('ssh_private_key_file')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('cron_expression')->limit(50),
                Tables\Columns\TextColumn::make('destination.name')->limit(50),
                Tables\Columns\TextColumn::make(
                    'cleanup_strategy_class'
                )->limit(50),
                Tables\Columns\TextColumn::make('keep_all_backups_for_days'),
                Tables\Columns\TextColumn::make('keep_daily_backups_for_days'),
                Tables\Columns\TextColumn::make(
                    'keep_weekly_backups_for_weeks'
                ),
                Tables\Columns\TextColumn::make(
                    'keep_monthly_backups_for_months'
                ),
                Tables\Columns\TextColumn::make(
                    'keep_yearly_backups_for_years'
                ),
                Tables\Columns\TextColumn::make(
                    'delete_oldest_backups_when_using_more_megabytes_than'
                ),
                Tables\Columns\TextColumn::make(
                    'healthy_maximum_backup_age_in_days'
                ),
                Tables\Columns\TextColumn::make(
                    'healthy_maximum_storage_in_mb'
                ),
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

                SelectFilter::make('destination_id')
                    ->multiple()
                    ->relationship('destination', 'name'),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }
}
