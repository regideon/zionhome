<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use App\Models\AssociationDue;
use App\Models\AssociationDueItem;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected array $selectedItemIds = [];

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->transactable_type === AssociationDue::class) {
            $data['association_due_id'] = $this->record->transactable_id;
        }

        $data['selected_item_ids'] = $this->record->items
            ->pluck('association_due_item_id')
            ->filter()
            ->values()
            ->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->selectedItemIds = $data['selected_item_ids'] ?? [];

        $data['transactable_type'] = AssociationDue::class;
        $data['transactable_id']   = $data['association_due_id'] ?? null;

        unset($data['association_due_id'], $data['selected_item_ids']);

        return $data;
    }

    protected function afterSave(): void
    {
        $this->record->items()->delete();

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
