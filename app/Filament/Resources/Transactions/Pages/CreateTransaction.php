<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use App\Models\AssociationDue;
use App\Models\AssociationDueItem;
use App\Support\ModuleReference;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected array $selectedItemIds = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->selectedItemIds = $data['selected_item_ids'] ?? [];

        $data['reference_no']      = ModuleReference::generate('transaction');
        $data['recorded_by']       = auth()->id();
        $data['transactable_type'] = AssociationDue::class;
        $data['transactable_id']   = $data['association_due_id'] ?? null;

        unset($data['association_due_id'], $data['selected_item_ids']);

        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->selectedItemIds as $itemId) {
            $dueItem = AssociationDueItem::find($itemId);

            if (! $dueItem) {
                continue;
            }

            $this->record->items()->create([
                'association_due_item_id' => $dueItem->id,
                'description'             => $dueItem->description ?? "{$dueItem->month_name} Dues",
                'amount'                  => $dueItem->amount,
            ]);
        }
    }
}
