<?php

namespace App\Filament\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('property_code')
                    ->label('Property')
                    ->searchable()
                    ->color('primary')
                    ->weight(FontWeight::Bold)
                    ->sortable(),

                TextColumn::make('currentOwnership.owner.name')
                    ->label('Owner')
                    ->weight(FontWeight::Bold)
                    ->searchable(),

                TextColumn::make('currentOccupancy.occupant.name')
                    ->label('Current Occupant')
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->placeholder('No occupant'),

                TextColumn::make('subdivisionPhase.name')
                    ->label('Phase')
                    ->sortable(),

                TextColumn::make('street.name')
                    ->label('Street')
                    ->searchable(),

                TextColumn::make('propertyType.name')
                    ->label('Type')
                    ->badge(),

                TextColumn::make('occupancyStatus.name')
                    ->label('Occupancy')
                    ->badge(),

                TextColumn::make('propertyStatus.name')
                    ->label('Status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('subdivision_phase_id')
                    ->label('Phase')
                    ->relationship('subdivisionPhase', 'name'),

                SelectFilter::make('street_id')
                    ->label('Street')
                    ->relationship('street', 'name'),

                SelectFilter::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name'),

                SelectFilter::make('occupancy_status_id')
                    ->label('Occupancy Status')
                    ->relationship('occupancyStatus', 'name'),

                SelectFilter::make('property_status_id')
                    ->label('Property Status')
                    ->relationship('propertyStatus', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
