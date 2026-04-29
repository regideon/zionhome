<?php

namespace App\Services;

use App\Models\AssociationDue;
use App\Models\AssociationDueItem;
use App\Models\ChartOfAccount;
use App\Models\JournalEntry;
use App\Models\JournalEntryLine;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Support\ModuleReference;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function post(Transaction $transaction): void
    {
        DB::transaction(function () use ($transaction) {
            $posted = TransactionStatus::where('code', 'POSTED')->firstOrFail();

            $transaction->update([
                'transaction_status_id' => $posted->id,
                'posted_at'             => now(),
                'posted_by'             => auth()->id(),
            ]);

            // Mark each linked AssociationDueItem as paid
            $paidStatus = \App\Models\AssociationDueItemStatus::where('code', 'PAID')->first();

            if ($paidStatus) {
                foreach ($transaction->items as $item) {
                    if ($item->associationDueItem) {
                        $item->associationDueItem->update([
                            'association_due_item_status_id' => $paidStatus->id,
                        ]);
                    }
                }
            }

            // Recalculate parent AssociationDue overall status
            if ($transaction->transactable instanceof AssociationDue) {
                $this->syncAssociationDueStatus($transaction->transactable);
            }

            // Auto-generate Journal Entry
            $this->generateJournalEntry($transaction);
        });
    }

    public function void(Transaction $transaction, string $reason): void
    {
        DB::transaction(function () use ($transaction, $reason) {
            $voided = TransactionStatus::where('code', 'VOIDED')->firstOrFail();

            $transaction->update([
                'transaction_status_id' => $voided->id,
                'voided_at'             => now(),
                'void_reason'           => $reason,
            ]);

            // Revert AssociationDueItem statuses to unpaid
            $unpaidStatus = \App\Models\AssociationDueItemStatus::where('code', 'UNPAID')->first();

            if ($unpaidStatus) {
                foreach ($transaction->items as $item) {
                    if ($item->associationDueItem) {
                        $item->associationDueItem->update([
                            'association_due_item_status_id' => $unpaidStatus->id,
                        ]);
                    }
                }
            }

            // Void the linked journal entry
            if ($transaction->journalEntry) {
                $transaction->journalEntry->update([
                    'status'      => 'VOIDED',
                    'voided_at'   => now(),
                    'void_reason' => "Voided with transaction {$transaction->reference_no}",
                ]);
            }

            if ($transaction->transactable instanceof AssociationDue) {
                $this->syncAssociationDueStatus($transaction->transactable);
            }
        });
    }

    private function generateJournalEntry(Transaction $transaction): JournalEntry
    {
        // Default accounts — adjust codes to match your seeded chart of accounts
        $cashAccount    = ChartOfAccount::where('code', '1010')->firstOrFail(); // Cash on Hand
        $revenueAccount = ChartOfAccount::where('code', '4010')->firstOrFail(); // HOA Dues Revenue

        $entry = JournalEntry::create([
            'reference_no'   => ModuleReference::generate('journal'),
            'transaction_id' => $transaction->id,
            'description'    => "Collection posted – {$transaction->reference_no}",
            'entry_date'     => $transaction->transaction_date,
            'status'         => 'POSTED',
            'posted_at'      => now(),
            'posted_by'      => auth()->id(),
        ]);

        JournalEntryLine::create([
            'journal_entry_id' => $entry->id,
            'account_id'       => $cashAccount->id,
            'description'      => $transaction->description,
            'debit'            => $transaction->amount,
            'credit'           => 0,
        ]);

        JournalEntryLine::create([
            'journal_entry_id' => $entry->id,
            'account_id'       => $revenueAccount->id,
            'description'      => $transaction->description,
            'debit'            => 0,
            'credit'           => $transaction->amount,
        ]);

        return $entry;
    }

    private function syncAssociationDueStatus(AssociationDue $due): void
    {
        $items      = $due->items;
        $totalItems = $items->count();
        $paidItems  = $items->whereNotNull('association_due_item_status_id')
            ->filter(fn($i) => optional($i->status)->code === 'PAID')
            ->count();

        // Derive overall status — adjust status IDs to match your seeded data
        $statusCode = match (true) {
            $paidItems === 0             => 'UNPAID',
            $paidItems === $totalItems   => 'PAID',
            default                      => 'PARTIAL',
        };

        $overallStatus = \App\Models\AssociationDueStatus::where('code', $statusCode)->first();

        if ($overallStatus) {
            $due->update(['association_due_status_id' => $overallStatus->id]);
        }
    }
}
