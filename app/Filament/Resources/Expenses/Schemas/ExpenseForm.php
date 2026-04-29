<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Expense Information')
                ->columnSpanFull()
                ->columns(4)
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->columnSpan(2),

                    TextInput::make('reference_no')
                        ->label('Reference No.'),

                    Select::make('expense_status_id')
                        ->relationship('status', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('expense_category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),



                    Select::make('vendor_id')
                        ->relationship('vendor', 'name')
                        ->searchable()
                        ->preload(),

                    Select::make('bank_account_id')
                        ->relationship('bankAccount', 'name')
                        ->searchable()
                        ->preload(),

                    DatePicker::make('expense_date')
                        ->default(now())
                        ->required(),

                    FileUpload::make('receipt_path')
                        ->label('Receipt')
                        ->directory('expenses/receipts')
                        ->columnSpanFull(),
                ]),

            Section::make('Expense Items')
                ->columnSpanFull()
                ->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->table([
                            TableColumn::make('Description'),
                            TableColumn::make('Quantity')->width('120px'),
                            TableColumn::make('Unit Price')->width('100px'),
                            TableColumn::make('Total Amount')->width('100px'),
                        ])
                        ->compact()
                        ->schema([
                            TextInput::make('description')
                                ->required()
                                ->columnSpan(2),

                            TextInput::make('quantity')
                                ->numeric()
                                ->default(1)
                                ->required(),

                            TextInput::make('unit_price')
                                ->numeric()
                                ->prefix('₱')
                                ->default(0)
                                ->required(),

                            TextInput::make('total_amount')
                                ->numeric()
                                ->prefix('₱')
                                ->default(0)
                                ->required(),
                        ])
                        ->columns(5)
                        ->defaultItems(1),
                ]),

            Section::make('Totals')
                ->columns(4)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('subtotal_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0),

                    TextInput::make('total_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->required(),

                    TextInput::make('paid_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0),

                    TextInput::make('balance_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0),
                ]),

            Section::make('Notes')
                ->columnSpanFull()
                ->schema([
                    Textarea::make('notes')->rows(3),
                ]),
        ]);
    }
}
