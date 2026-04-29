<?php

namespace App\Livewire\Community\Bills;

use App\Models\AssociationDue;
use App\Models\AssociationDueItem;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Collection;

#[Layout('layouts.community')]
class PayAssociationDue extends Component
{
    use WithFileUploads;

    public AssociationDue $due;

    public array  $selectedItemIds = [];
    public string $paymentMethod   = 'gcash';
    public string $referenceNumber = '';
    public string $paidDate        = '';
    public string $amountPaid      = '';
    public $receipt                = null;

    public function mount(AssociationDue $due): void
    {
        $this->due = $due->load(['items.status', 'status', 'property', 'homeownerProfile']);

        $this->selectedItemIds = $due->items
            ->filter(fn($item) => in_array($item->status?->name, ['Draft', 'Unpaid']))
            ->pluck('id')
            ->map(fn($id) => (string) $id)
            ->toArray();

        $this->paidDate   = now()->format('Y-m-d');
        $this->amountPaid = (string) $this->selectedTotal;
    }

    #[Computed]
    public function selectedTotal(): float
    {
        if (empty($this->selectedItemIds)) {
            return 0;
        }

        return (float) AssociationDueItem::whereIn('id', $this->selectedItemIds)
            ->sum('balance_amount');
    }

    

    // add after selectedTotal():
    #[Computed]
    public function payableItems(): Collection
    {
        return $this->due->items()
            ->with('status')
            ->whereHas('status', fn($q) => $q->whereIn('name', ['Draft', 'Unpaid']))
            ->get();
    }


    public function toggleItem(int $id): void
    {
        $key = (string) $id;

        if (in_array($key, $this->selectedItemIds)) {
            $this->selectedItemIds = array_values(
                array_filter($this->selectedItemIds, fn($i) => $i !== $key)
            );
        } else {
            $this->selectedItemIds[] = $key;
        }

        $this->amountPaid = (string) $this->selectedTotal;
    }

    public function selectPaymentMethod(string $method): void
    {
        $this->paymentMethod = $method;
    }

    public function submit(): void
    {
        $this->validate([
            'selectedItemIds' => 'required|array|min:1',
            'paymentMethod'   => 'required|string',
            'referenceNumber' => 'required|string|max:100',
            'paidDate'        => 'required|date',
            'amountPaid'      => 'required|numeric|min:1',
            'receipt'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $receiptPath = null;
        if ($this->receipt) {
            $receiptPath = $this->receipt->store('payment-receipts', 'public');
        }

        // TODO: wire to TransactionService — create transaction + update item statuses to "Pending Verification"

        session()->flash('success', 'Payment submitted successfully! Pending accounting verification.');
        $this->redirect(route('community.bills'));
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.community.bills.pay-association-due');
    }
}
