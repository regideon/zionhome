<?php

namespace App\Filament\Resources\AssociationDues\Schemas;

use App\Models\AssociationDueItemStatus;
use App\Models\AssociationDueLookup;
use App\Models\AssociationDueLookupItem;
use App\Models\AssociationDueStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class AssociationDueForm
{
    public static function configure(Schema $schema): Schema
    {
        $paidStatusId = (int) AssociationDueItemStatus::where('name', 'Paid')->value('id');

        return $schema->components([
            Section::make('Yearly Association Due Header')
                ->columns(4)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('reference_no')
                        ->label('Reference No.')
                        ->disabled()
                        ->dehydrated()
                        ->placeholder('Auto-generated'),

                    Select::make('homeowner_profile_id')
                        ->relationship(
                            name: 'homeownerProfile',
                            titleAttribute: 'homeowner_code',
                            modifyQueryUsing: fn($query) => $query->with('user'),
                        )
                        ->getOptionLabelFromRecordUsing(
                            fn($record) => trim(($record->user?->name . ' - ' ?? '') . ($record->homeowner_code ?? ''))
                        )
                        ->disabled()
                        ->dehydrated()
                        ->searchable()
                        ->columnSpan(2)
                        ->preload(),


                    Select::make('property_id')
                        ->relationship('property', 'id')
                        ->getOptionLabelFromRecordUsing(
                            fn($record) => $record->property_code
                                ?? $record->block_lot
                                ?? $record->name
                                ?? 'Property #' . $record->id
                        )
                        ->searchable()
                        ->preload()
                        ->required(),





                    Select::make('association_due_lookup_id')
                        ->label('Billing Year Lookup')
                        ->relationship('lookup', 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->required()
                        ->afterStateUpdated(function ($state, $set) {
                            if (! $state) {
                                return;
                            }

                            $lookup = AssociationDueLookup::with('items')
                                ->find($state);

                            if (! $lookup) {
                                return;
                            }

                            $set('billing_year', $lookup->billing_year);

                            $draftStatusId = AssociationDueItemStatus::where('name', 'Draft')->value('id')
                                ?? AssociationDueItemStatus::where('name', 'Unpaid')->value('id');

                            $items = $lookup->items
                                ->sortBy('billing_month')
                                ->map(fn($item) => [
                                    'association_due_lookup_item_id' => $item->id,
                                    'association_due_item_status_id' => $draftStatusId,
                                    'billing_month' => $item->billing_month,
                                    'month_name' => $item->month_name,
                                    'due_date' => $item->due_date?->format('Y-m-d'),
                                    'description' => "{$item->month_name} {$lookup->billing_year} Association Dues",
                                    'amount' => $item->amount,
                                    'paid_amount' => 0,
                                    'balance_amount' => $item->amount,
                                ])
                                ->values()
                                ->toArray();

                            $set('items', $items);

                            $total = collect($items)->sum('amount');

                            $set('subtotal_amount', $total);
                            $set('total_amount', $total);
                            $set('paid_amount', 0);
                            $set('balance_amount', $total);
                        }),

                    TextInput::make('billing_year')
                        ->numeric()
                        ->required()
                        ->disabled()
                        ->dehydrated(),

                    Select::make('association_due_status_id')
                        ->label('Overall Status')
                        ->relationship('status', 'name')
                        ->default(fn() => AssociationDueStatus::where('name', 'Unpaid')->value('id'))
                        ->required(),

                    Hidden::make('association_due_type_id')->default(2),
                    // Select::make('association_due_type_id')
                    //     ->label('Due Type')
                    //     ->relationship('type', 'name')
                    //     ->searchable()
                    //     ->preload()
                    //     ->required(),






                ]),


            Section::make('Monthly Due Items')
                ->columnSpanFull()
                ->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->table([
                            TableColumn::make('Month Name')->width('110px'),
                            TableColumn::make('Amount')->width('120px'),
                            TableColumn::make('Paid Amount')->width('120px'),
                            TableColumn::make('Balance Amount')->width('120px'),
                            TableColumn::make('Due Date')->width('120px'),
                            TableColumn::make('Status')->width('140px'),
                            TableColumn::make('Payment Method')->width('130px'),
                            TableColumn::make('Payment Date')->width('130px'),
                        ])
                        ->compact()
                        ->schema([
                            Hidden::make('association_due_lookup_item_id'),

                            TextInput::make('month_name')
                                ->disabled()
                                ->dehydrated(),

                            TextInput::make('amount')
                                ->numeric()
                                ->prefix('₱')
                                ->default(0)
                                ->live()
                                ->required()
                                ->afterStateUpdated(function ($state, $get, $set) {
                                    $paid = (float) ($get('paid_amount') ?? 0);
                                    $amount = (float) ($state ?? 0);

                                    $set('balance_amount', max($amount - $paid, 0));
                                }),

                            TextInput::make('paid_amount')
                                ->numeric()
                                ->prefix('₱')
                                ->default(0)
                                ->disabled()
                                ->dehydrated(),

                            TextInput::make('balance_amount')
                                ->numeric()
                                ->prefix('₱')
                                ->default(0)
                                ->disabled()
                                ->dehydrated(),

                            DatePicker::make('due_date')
                                ->required(),

                            Select::make('association_due_item_status_id')
                                ->relationship('status', 'name')
                                // ->searchable()
                                // ->preload()
                                ->live()
                                ->required(),

                            Select::make('payment_method_id')
                                ->hiddenLabel()
                                ->relationship('paymentMethod', 'name', fn($query) => $query->where('is_active', true))
                                ->nullable()
                                ->required(
                                    fn(Get $get): bool =>
                                    (int) $get('association_due_item_status_id') === $paidStatusId
                                )
                                ->columnSpan(1),

                            DatePicker::make('payment_date')
                                ->hiddenLabel()
                                ->default(today())
                                // ->disabled(
                                //     fn(Get $get): bool =>
                                //     (int) $get('association_due_item_status_id') === $paidStatusId
                                // )
                                ->dehydrated()
                                ->nullable(),



                        ])
                        ->columns(8)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderable(false)
                        ->defaultItems(0),
                ]),


            Section::make('Yearly Totals')
                ->columns(5)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('subtotal_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->disabled()
                        ->dehydrated(),

                    TextInput::make('discount_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->live()
                        ->afterStateUpdated(function ($state, $get, $set) {
                            self::recalculateHeaderAmounts($get, $set);
                        }),

                    TextInput::make('penalty_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->live()
                        ->afterStateUpdated(function ($state, $get, $set) {
                            self::recalculateHeaderAmounts($get, $set);
                        }),

                    TextInput::make('total_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->disabled()
                        ->dehydrated(),

                    TextInput::make('paid_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->disabled()
                        ->dehydrated(),

                    TextInput::make('balance_amount')
                        ->numeric()
                        ->prefix('₱')
                        ->default(0)
                        ->disabled()
                        ->dehydrated(),
                ]),



            Section::make('Notes')
                ->columnSpanFull()
                ->schema([
                    Textarea::make('notes')
                        ->rows(3),
                ]),
        ]);
    }

    protected static function recalculateHeaderAmounts($get, $set): void
    {
        $subtotal = (float) ($get('subtotal_amount') ?? 0);
        $discount = (float) ($get('discount_amount') ?? 0);
        $penalty = (float) ($get('penalty_amount') ?? 0);
        $paid = (float) ($get('paid_amount') ?? 0);

        $total = max(($subtotal - $discount) + $penalty, 0);

        $set('total_amount', $total);
        $set('balance_amount', max($total - $paid, 0));
    }
}
