<?php

namespace App\Filament\Resources\ChartOfAccounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ChartOfAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Account Information')
                ->columns(2)
                ->schema([
                    Select::make('account_type_id')
                        ->relationship('accountType', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('code')
                        ->required()
                        ->unique(ignoreRecord: true),

                    TextInput::make('name')
                        ->required()
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->default(true),
                ]),
        ]);
    }
}