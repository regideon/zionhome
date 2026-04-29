<?php

namespace App\Filament\Resources\Collections\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CollectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Payment Details')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    Select::make('association_due_id')
                        ->relationship('associationDue', 'reference_no')
                        ->searchable()
                        ->preload(),

                    Select::make('property_id')
                        ->relationship('property', 'id')
                        ->getOptionLabelFromRecordUsing(
                            fn($record) => $record->name ?? $record->block_lot ?? 'Property #' . $record->id
                        )
                        ->searchable()
                        ->preload(),

                    Select::make('homeowner_profile_id')
                        ->relationship('homeownerProfile', 'homeowner_code')
                        ->searchable()
                        ->preload(),

                    Select::make('payment_method_id')
                        ->relationship('paymentMethod', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('payment_status_id')
                        ->relationship('paymentStatus', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('bank_account_id')
                        ->relationship('bankAccount', 'name')
                        ->searchable()
                        ->preload(),

                    TextInput::make('reference_no')
                        ->label('System Reference No.'),

                    TextInput::make('external_reference_no')
                        ->label('Bank / GCash Reference No.'),

                    DatePicker::make('paid_date')
                        ->default(now())
                        ->required(),

                    TextInput::make('amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->required(),

                    FileUpload::make('receipt_path')
                        ->label('Receipt')
                        ->directory('collections/receipts')
                        ->columnSpanFull(),
                ]),

            Section::make('Verification')
                ->columns(2)
                ->schema([
                    DateTimePicker::make('verified_at'),

                    Textarea::make('notes')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
