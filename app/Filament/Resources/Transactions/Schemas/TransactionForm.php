<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\AssociationDue;
use App\Models\AssociationDueItem;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Transaction Details')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('reference_no')
                        ->label('Reference No.')
                        ->disabled()
                        ->dehydrated()
                        ->placeholder('Auto-generated'),

                    Select::make('transaction_type_id')
                        ->label('Type')
                        ->options(TransactionType::where('is_active', true)->pluck('name', 'id'))
                        ->default(fn() => TransactionType::where('code', 'COLLECTION')->value('id'))
                        ->required(),

                    Select::make('transaction_status_id')
                        ->label('Status')
                        ->options(TransactionStatus::pluck('name', 'id'))
                        ->default(fn() => TransactionStatus::where('code', 'DRAFT')->value('id'))
                        ->disabled()
                        ->dehydrated()
                        ->required(),

                    DatePicker::make('transaction_date')
                        ->label('Transaction Date')
                        ->default(today())
                        ->required(),

                    Select::make('payment_method')
                        ->options([
                            'cash'          => 'Cash',
                            'gcash'         => 'GCash',
                            'bank_transfer' => 'Bank Transfer',
                            'check'         => 'Check',
                            'other'         => 'Other',
                        ])
                        ->required(),

                    Select::make('user_id')
                        ->label('Payer (Homeowner)')
                        ->relationship('payer', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable(),
                ]),

            Section::make('Linked Association Due')
                ->columnSpanFull()
                ->schema([
                    Select::make('association_due_id')
                        ->label('Association Due')
                        ->options(function () {
                            return AssociationDue::with(['homeownerProfile', 'property'])
                                ->get()
                                ->mapWithKeys(fn($due) => [
                                    $due->id => "[{$due->reference_no}] "
                                        . ($due->homeownerProfile?->name ?? 'N/A')
                                        . ' – ' . ($due->property?->block_lot ?? 'Property #' . $due->property_id)
                                        . ' (' . $due->billing_year . ')',
                                ])
                                ->toArray();
                        })
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(fn($set) => $set('selected_item_ids', []))
                        ->dehydrated(false),

                    CheckboxList::make('selected_item_ids')
                        ->label('Select months to pay')
                        ->options(function ($get) {
                            $dueId = $get('association_due_id');

                            if (! $dueId) {
                                return [];
                            }

                            return AssociationDueItem::where('association_due_id', $dueId)
                                ->whereHas('status', fn($q) => $q->whereIn('name', ['Unpaid', 'Draft', 'Partial']))
                                ->orderBy('billing_month')
                                ->get()
                                ->mapWithKeys(fn($item) => [
                                    $item->id => "{$item->month_name} — ₱" . number_format($item->amount, 2),
                                ])
                                ->toArray();
                        })
                        ->live()
                        ->afterStateUpdated(function ($state, $set) {
                            $total = AssociationDueItem::whereIn('id', $state ?? [])->sum('amount');
                            $set('amount', $total);
                        })
                        ->columns(4)
                        ->dehydrated(false),
                ]),

            Section::make('Amount & Proof')
                ->columns(2)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->disabled()
                        ->dehydrated()
                        ->required(),

                    FileUpload::make('receipt_image')
                        ->label('Receipt / Proof of Payment')
                        ->image()
                        ->directory('receipts')
                        ->nullable(),
                ]),

            Section::make('Notes')
                ->columnSpanFull()
                ->schema([
                    Textarea::make('description')->rows(2),
                    Textarea::make('notes')->rows(2),
                ]),
        ]);
    }
}
