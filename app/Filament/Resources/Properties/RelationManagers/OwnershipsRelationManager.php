<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OwnershipsRelationManager extends RelationManager
{
    protected static string $relationship = 'ownerships';

    protected static ?string $title = 'Property Owners';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('owner_user_id')
                    ->label('Owner')
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('ownership_type')
                    ->label('Ownership Type')
                    ->options([
                        'owner' => 'Owner',
                        'co_owner' => 'Co-owner',
                        'representative' => 'Representative',
                    ])
                    ->default('owner')
                    ->required(),

                DatePicker::make('start_date')
                    ->label('Start Date'),

                DatePicker::make('end_date')
                    ->label('End Date'),

                Select::make('is_current')
                    ->label('Current Owner?')
                    ->options([
                        1 => 'Yes',
                        0 => 'No',
                    ])
                    ->default(1)
                    ->required(),

                Textarea::make('remarks')
                    ->label('Remarks')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('owner.name')
                    ->label('Owner')
                    ->searchable(),

                TextColumn::make('ownership_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn($state) => str($state)->replace('_', ' ')->title()),

                IconColumn::make('is_current')
                    ->label('Current')
                    ->boolean(),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date(),

                TextColumn::make('end_date')
                    ->label('End Date')
                    ->date()
                    ->placeholder('—'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
