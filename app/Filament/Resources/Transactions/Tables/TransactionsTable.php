<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use App\Services\TransactionService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref No.')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type.name')
                    ->badge(),

                TextColumn::make('transactable.reference_no')
                    ->label('Due Ref')
                    ->searchable(),

                TextColumn::make('payer.name')
                    ->label('Payer')
                    ->searchable(),

                TextColumn::make('amount')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'cash'          => 'Cash',
                        'gcash'         => 'GCash',
                        'bank_transfer' => 'Bank Transfer',
                        'check'         => 'Check',
                        default         => ucfirst($state ?? ''),
                    }),

                TextColumn::make('transaction_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('status.name')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Draft'   => 'gray',
                        'Pending' => 'warning',
                        'Posted'  => 'success',
                        'Voided'  => 'danger',
                        default   => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('transaction_status_id')
                    ->label('Status')
                    ->relationship('status', 'name'),

                SelectFilter::make('transaction_type_id')
                    ->label('Type')
                    ->relationship('type', 'name'),

                SelectFilter::make('payment_method')
                    ->options([
                        'cash'          => 'Cash',
                        'gcash'         => 'GCash',
                        'bank_transfer' => 'Bank Transfer',
                        'check'         => 'Check',
                        'other'         => 'Other',
                    ]),
            ])
            ->actions([
                ViewAction::make(),

                Action::make('post')
                    ->label('Post')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Post Transaction')
                    ->modalDescription('This will mark selected months as paid and auto-generate a journal entry. Cannot be undone.')
                    ->visible(fn(Transaction $record) => ! $record->isPosted() && ! $record->isVoided())
                    ->action(function (Transaction $record) {
                        try {
                            app(TransactionService::class)->post($record);
                            Notification::make()->title('Transaction posted')->success()->send();
                        } catch (\Throwable $e) {
                            Notification::make()->title('Post failed')->body($e->getMessage())->danger()->send();
                        }
                    }),

                Action::make('void')
                    ->label('Void')
                    ->icon(Heroicon::OutlinedXCircle)
                    ->color('danger')
                    ->visible(fn(Transaction $record) => $record->isPosted())
                    ->schema([
                        Textarea::make('void_reason')
                            ->label('Reason for voiding')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (Transaction $record, array $data) {
                        try {
                            app(TransactionService::class)->void($record, $data['void_reason']);
                            Notification::make()->title('Transaction voided')->success()->send();
                        } catch (\Throwable $e) {
                            Notification::make()->title('Void failed')->body($e->getMessage())->danger()->send();
                        }
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
