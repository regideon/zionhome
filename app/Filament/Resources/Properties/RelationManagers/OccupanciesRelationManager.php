<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OccupanciesRelationManager extends RelationManager
{
    protected static string $relationship = 'occupancies';

    protected static ?string $title = 'Current Occupants / Tenants';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('occupant_user_id')
                    ->label('Registered Occupant')
                    ->relationship('occupant', 'name')
                    ->searchable()
                    ->preload(),

                TextInput::make('occupant_name')
                    ->label('Occupant Name')
                    ->helperText('Use this if the tenant is not yet registered as a user.'),

                TextInput::make('contact_number')
                    ->label('Contact Number'),

                Select::make('occupancy_type')
                    ->label('Occupancy Type')
                    ->options([
                        'owner' => 'Owner',
                        'tenant' => 'Tenant',
                        'caretaker' => 'Caretaker',
                        'relative' => 'Relative',
                    ])
                    ->default('tenant')
                    ->required(),

                DatePicker::make('move_in_date')
                    ->label('Move-in Date'),

                DatePicker::make('move_out_date')
                    ->label('Move-out Date'),

                Select::make('is_current')
                    ->label('Current Occupant?')
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
                TextColumn::make('occupant.name')
                    ->label('Registered User')
                    ->placeholder('Not registered')
                    ->searchable(),

                TextColumn::make('occupant_name')
                    ->label('Occupant Name')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('contact_number')
                    ->label('Contact'),

                TextColumn::make('occupancy_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn($state) => str($state)->replace('_', ' ')->title()),

                IconColumn::make('is_current')
                    ->label('Current')
                    ->boolean(),

                TextColumn::make('move_in_date')
                    ->label('Move-in')
                    ->date(),

                TextColumn::make('move_out_date')
                    ->label('Move-out')
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
