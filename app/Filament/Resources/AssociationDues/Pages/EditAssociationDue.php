<?php

namespace App\Filament\Resources\AssociationDues\Pages;

use App\Filament\Resources\AssociationDues\AssociationDueResource;
use App\Models\AssociationDue;
use App\Models\AssociationDueItem;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Services\TransactionService;
use App\Support\ModuleReference;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditAssociationDue extends EditRecord
{
    protected static string $resource = AssociationDueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            /*
            Action::make('recordPayment')
                ->label('Record Payment')
                ->icon(Heroicon::OutlinedCurrencyDollar)
                ->color('success')
                ->modalHeading('Record Payment')
                ->modalWidth('lg')
                // ✅ use loaded collection, not a new query
                ->visible(
                    fn() => $this->record->items
                        ->filter(fn($item) => in_array($item->status?->name, ['Unpaid', 'Draft', 'Partial']))
                        ->isNotEmpty()
                )
                ->schema([
                    CheckboxList::make('selected_item_ids')
                        ->label('Months to Pay')
                        // ✅ use loaded collection, not a new query
                        ->options(
                            fn() => $this->record->items
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
                ->action(function (array $data) {
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
                        'transactable_id'       => $this->record->id,
                        'user_id'               => $this->record->homeownerProfile?->user_id ?? null,
                        'amount'                => $total,
                        'payment_method'        => $data['payment_method'],
                        'receipt_image'         => $data['receipt_image'] ?? null,
                        'transaction_date'      => $data['transaction_date'],
                        'description'           => "Payment for {$this->record->reference_no}",
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

                    $this->refreshFormData([
                        'association_due_status_id',
                        'paid_amount',
                        'balance_amount',
                    ]);
                })
                ->visible(
                    fn() => $this->record->items()
                        ->whereHas('status', fn($q) => $q->whereIn('name', ['Unpaid', 'Draft', 'Partial']))
                        ->exists()
                ),

            */

            // DeleteAction::make(),
        ];
    }
}
