<?php

namespace App\Filament\Resources\AssociationDues\Tables;

use App\Models\AssociationDue;
use App\Models\AssociationDueItem;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Services\TransactionService;
use App\Support\ModuleReference;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AssociationDuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref No.')
                    ->weight(FontWeight::Bold)
                    ->searchable(),

                TextColumn::make('property.property_code')
                    ->label('Property')
                    ->color('primary')
                    ->weight(FontWeight::Bold)
                    ->formatStateUsing(fn($record) => $record->property?->property_code ?? $record->property?->block_lot ?? 'Property #' . $record->property_id),

                TextColumn::make('homeownerProfile.user.name')
                    ->label('Homeowner')
                    ->weight(FontWeight::Bold)
                    ->searchable(),

                TextColumn::make('type.name')
                    ->badge(),

                // TextColumn::make('billing_frequency')
                //     ->badge()
                //     ->formatStateUsing(fn($state) => ucfirst(str_replace('_', ' ', $state))),

                TextColumn::make('billing_year'),

                TextColumn::make('total_amount')
                    ->money('PHP'),

                TextColumn::make('paid_amount')
                    ->money('PHP'),

                TextColumn::make('balance_amount')
                    ->money('PHP'),

                TextColumn::make('status.name')
                    ->badge()
                    ->color(fn($record) => $record->status?->color ?? 'gray'),

                // TextColumn::make('due_date')
                //     ->date(),
            ])
            ->filters([
                SelectFilter::make('association_due_status_id')
                    ->label('Status')
                    ->relationship('status', 'name'),

                SelectFilter::make('association_due_type_id')
                    ->label('Type')
                    ->relationship('type', 'name'),

                // SelectFilter::make('billing_frequency')
                //     ->options([
                //         'monthly'  => 'Monthly',
                //         'yearly'   => 'Yearly',
                //         'one_time' => 'One Time',
                //     ]),
            ])
            ->actions([
                /*
                Action::make('recordPayment')
                    ->label('Record Payment')
                    ->icon(Heroicon::OutlinedCurrencyDollar)
                    ->color('success')
                    ->modalHeading('Record Payment')
                    ->modalWidth('lg')
                    ->visible(
                        fn(AssociationDue $record) => $record->items
                            ->filter(fn($item) => in_array($item->status?->name, ['Unpaid', 'Draft', 'Partial']))
                            ->isNotEmpty()
                    )

                    ->schema([
                        CheckboxList::make('selected_item_ids')
                            ->label('Months to Pay')
                            ->options(
                                fn(AssociationDue $record) => $record->items
                                    ->filter(fn($item) => in_array($item->status?->name, ['Unpaid', 'Draft', 'Partial']))
                                    ->sortBy('billing_month')
                                    ->mapWithKeys(fn($item) => [
                                        $item->id => "{$item->month_name} — ₱" . number_format($item->amount, 2),
                                    ])
                                    ->toArray()
                            )

                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                $total = AssociationDueItem::whereIn('id', $state ?? [])->sum('amount');
                                $set('amount', $total);
                            })
                            ->columns(3)
                            ->required(),

                        TextInput::make('amount')
                            ->label('Total Amount')
                            ->prefix('₱')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(),

                        Select::make('payment_method')
                            ->options([
                                'cash'          => 'Cash',
                                'gcash'         => 'GCash',
                                'bank_transfer' => 'Bank Transfer',
                                'check'         => 'Check',
                                'other'         => 'Other',
                            ])
                            ->required(),

                        DatePicker::make('transaction_date')
                            ->label('Payment Date')
                            ->default(today())
                            ->required(),

                        FileUpload::make('receipt_image')
                            ->label('Receipt / Proof of Payment')
                            ->image()
                            ->directory('receipts')
                            ->nullable(),

                        Textarea::make('notes')
                            ->rows(2)
                            ->nullable(),
                    ])
                    ->action(function (AssociationDue $record, array $data) {
                        $selectedIds = $data['selected_item_ids'] ?? [];

                        if (empty($selectedIds)) {
                            Notification::make()->title('No months selected')->warning()->send();
                            return;
                        }

                        $total = AssociationDueItem::whereIn('id', $selectedIds)->sum('amount');

                        $transaction = Transaction::create([
                            'reference_no'          => ModuleReference::generate('transaction'),
                            'transaction_type_id'   => TransactionType::where('code', 'COLLECTION')->value('id'),
                            'transaction_status_id' => TransactionStatus::where('code', 'DRAFT')->value('id'),
                            'transactable_type'     => AssociationDue::class,
                            'transactable_id'       => $record->id,
                            'user_id'               => $record->homeownerProfile?->user_id ?? null,
                            'amount'                => $total,
                            'payment_method'        => $data['payment_method'],
                            'receipt_image'         => $data['receipt_image'] ?? null,
                            'transaction_date'      => $data['transaction_date'],
                            'description'           => "Payment for {$record->reference_no}",
                            'notes'                 => $data['notes'] ?? null,
                            'recorded_by'           => auth()->id(),
                        ]);

                        foreach ($selectedIds as $itemId) {
                            $dueItem = AssociationDueItem::find($itemId);

                            if (! $dueItem) {
                                continue;
                            }

                            $transaction->items()->create([
                                'association_due_item_id' => $dueItem->id,
                                'description'             => $dueItem->description ?? "{$dueItem->month_name} Dues",
                                'amount'                  => $dueItem->amount,
                            ]);
                        }

                        app(TransactionService::class)->post($transaction);

                        Notification::make()
                            ->title('Payment recorded successfully')
                            ->body("Transaction {$transaction->reference_no} posted.")
                            ->success()
                            ->send();
                    }),

                */
                // EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
