<?php

namespace App\Filament\Resources\BankAccounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BankAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Bank / Cash Account')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),

                    Select::make('type')
                        ->options([
                            'bank' => 'Bank',
                            'cash' => 'Cash',
                            'gcash' => 'GCash / E-Wallet',
                        ])
                        ->default('bank')
                        ->required(),

                    TextInput::make('bank_name'),

                    TextInput::make('account_number'),

                    Select::make('chart_of_account_id')
                        ->relationship('chartOfAccount', 'name')
                        ->searchable()
                        ->preload(),

                    TextInput::make('opening_balance')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0),

                    Toggle::make('is_active')
                        ->default(true),
                ]),
        ]);
    }
}
