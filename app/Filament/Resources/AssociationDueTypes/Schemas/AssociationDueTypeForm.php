<?php

namespace App\Filament\Resources\AssociationDueTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssociationDueTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Due Type')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),

                    Select::make('income_account_id')
                        ->label('Income Account')
                        ->relationship('incomeAccount', 'name')
                        ->searchable()
                        ->preload(),

                    Toggle::make('is_active')
                        ->default(true),
                ]),
        ]);
    }
}