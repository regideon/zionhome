<?php

namespace App\Filament\Resources\ExpenseCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExpenseCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Expense Category')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),

                    Select::make('expense_account_id')
                        ->label('Expense Account')
                        ->relationship('expenseAccount', 'name')
                        ->searchable()
                        ->preload(),

                    Toggle::make('is_active')
                        ->default(true),
                ]),
        ]);
    }
}