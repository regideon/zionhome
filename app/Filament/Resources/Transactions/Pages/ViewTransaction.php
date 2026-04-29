<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use App\Services\TransactionService;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('post')
                ->label('Post Transaction')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Post Transaction')
                ->modalDescription('This will mark selected months as paid and auto-generate a journal entry. Cannot be undone.')
                ->visible(fn() => ! $this->record->isPosted() && ! $this->record->isVoided())
                ->action(function () {
                    try {
                        app(TransactionService::class)->post($this->record);
                        $this->refreshFormData([]);
                        Notification::make()->title('Transaction posted successfully')->success()->send();
                    } catch (\Throwable $e) {
                        Notification::make()->title('Post failed')->body($e->getMessage())->danger()->send();
                    }
                }),

            Action::make('void')
                ->label('Void Transaction')
                ->icon(Heroicon::OutlinedXCircle)
                ->color('danger')
                ->visible(fn() => $this->record->isPosted())
                ->schema([
                    Textarea::make('void_reason')
                        ->label('Reason for voiding')
                        ->required()
                        ->rows(3),
                ])
                ->action(function (array $data) {
                    try {
                        app(TransactionService::class)->void($this->record, $data['void_reason']);
                        $this->refreshFormData([]);
                        Notification::make()->title('Transaction voided')->success()->send();
                    } catch (\Throwable $e) {
                        Notification::make()->title('Void failed')->body($e->getMessage())->danger()->send();
                    }
                }),

            EditAction::make()
                ->visible(fn() => ! $this->record->isPosted() && ! $this->record->isVoided()),
        ];
    }
}
