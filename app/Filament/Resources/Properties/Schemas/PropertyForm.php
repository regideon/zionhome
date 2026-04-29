<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Models\Area;
use App\Models\Street;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Property Details')
                    ->columns(3)
                    ->schema([
                        TextInput::make('property_code')
                            ->label('Property Code')
                            ->placeholder('BLK3-LOT4B')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('block_no')
                            ->label('Block No.')
                            ->maxLength(255),

                        TextInput::make('lot_no')
                            ->label('Lot No.')
                            ->maxLength(255),

                        TextInput::make('house_no')
                            ->label('House No.')
                            ->maxLength(255),

                        TextInput::make('lot_area_sqm')
                            ->label('Lot Area (sqm)')
                            ->numeric(),

                        Select::make('property_type_id')
                            ->label('Property Type')
                            ->relationship('propertyType', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('property_status_id')
                            ->label('Property Status')
                            ->relationship('propertyStatus', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('occupancy_status_id')
                            ->label('Occupancy Status')
                            ->relationship('occupancyStatus', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(2)
                            ->required(),
                    ]),

                Section::make('Location Details')
                    ->columns(2)
                    ->schema([
                        Select::make('city_id')
                            ->label('City')
                            ->relationship('city', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),

                        Select::make('area_id')
                            ->label('Area / Barangay')
                            ->options(fn($get) => Area::query()
                                ->when($get('city_id'), fn($query, $cityId) => $query->where('city_id', $cityId))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Select::make('subdivision_phase_id')
                            ->label('Phase')
                            ->relationship('subdivisionPhase', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn($set) => $set('street_id', null))
                            ->required(),

                        Select::make('street_id')
                            ->label('Street')
                            ->options(fn($get) => Street::query()
                                ->when($get('subdivision_phase_id'), fn($query, $phaseId) => $query->where('subdivision_phase_id', $phaseId))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->live(),


                        Textarea::make('address')
                            ->label('Full Address')
                            ->columnSpanFull(),
                    ]),

                Section::make('Notes')
                    ->schema([
                        Textarea::make('remarks')
                            ->label('Remarks')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
