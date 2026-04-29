<?php

namespace App\Services;

use App\Models\AssociationDue;
use App\Models\AssociationDueItemStatus;
use App\Models\AssociationDueLookup;
use App\Models\AssociationDueStatus;
use App\Models\AssociationDueType;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * 
 * # Basic — generates for 2026, ₱1,000/month, due on the 15th (all items as Draft)
php artisan zionhome:generate-association-dues 2026

 * # Custom amount and due day
php artisan zionhome:generate-association-dues 2026 --amount=1500 --due-day=15

 * # Publish immediately (items created as Unpaid instead of Draft)
php artisan zionhome:generate-association-dues 2026 --amount=1500 --due-day=15 --publish

 * # Omit year → defaults to next year automatically
php artisan zionhome:generate-association-dues --amount=1500 --publish
 */
class AssociationDueGeneratorService
{
    public function generateForYear(
        int $billingYear,
        float $monthlyAmount = 1000,
        int $dueDay = 15,
        bool $publish = false
    ): AssociationDueLookup {
        return DB::transaction(function () use ($billingYear, $monthlyAmount, $dueDay, $publish) {
            $lookup = $this->createOrUpdateLookup($billingYear, $monthlyAmount, $dueDay);

            $this->createLookupItems($lookup, $billingYear, $monthlyAmount, $dueDay);

            $this->createAssociationDuesForHomeowners($lookup, $billingYear, $publish);

            $lookup->update([
                'is_generated' => true,
                'is_published' => $publish,
            ]);

            return $lookup;
        });
    }

    private function createOrUpdateLookup(
        int $billingYear,
        float $monthlyAmount,
        int $dueDay
    ): AssociationDueLookup {
        return AssociationDueLookup::updateOrCreate(
            ['billing_year' => $billingYear],
            [
                'name' => "{$billingYear} Association Dues",
                'default_monthly_amount' => $monthlyAmount,
                'default_due_day' => $dueDay,
                'is_active' => true,
            ]
        );
    }

    private function createLookupItems(
        AssociationDueLookup $lookup,
        int $billingYear,
        float $monthlyAmount,
        int $dueDay
    ): void {
        foreach (range(1, 12) as $month) {
            $monthDate = Carbon::create($billingYear, $month, 1);

            $dueDate = $monthDate->copy()->day(
                min($dueDay, $monthDate->daysInMonth)
            );

            $lookup->items()->updateOrCreate(
                ['billing_month' => $month],
                [
                    'month_name' => $dueDate->format('F'),
                    'due_date' => $dueDate->toDateString(),
                    'amount' => $monthlyAmount,
                    'is_active' => true,
                ]
            );
        }
    }

    private function createAssociationDuesForHomeowners(
        AssociationDueLookup $lookup,
        int $billingYear,
        bool $publish
    ): void {
        $headerStatusId = AssociationDueStatus::where('name', 'Unpaid')->value('id');

        $itemStatusName = $publish ? 'Unpaid' : 'Draft';

        $itemStatusId = AssociationDueItemStatus::where('name', $itemStatusName)->value('id');



        $lookupItems = $lookup->items()
            ->orderBy('billing_month')
            ->get();

        User::role('homeowner')
            ->with([
                'homeownerProfile',
                'homeownerProfile.propertyOwnerships.property',
            ])
            ->chunkById(100, function ($users) use (
                $lookup,
                $billingYear,
                $headerStatusId,
                $itemStatusId,
                $lookupItems
            ) {
                foreach ($users as $user) {
                    $homeownerProfile = $user->homeownerProfile;

                    if (! $homeownerProfile) {
                        continue;
                    }

                    foreach ($homeownerProfile->propertyOwnerships as $ownership) {
                        $property = $ownership->property;

                        if (! $property) {
                            continue;
                        }

                        $associationDueTypeId = AssociationDueType::where('name', 'Yearly Association Dues')->value('id');

                        $this->createYearlyDueForProperty(
                            lookup: $lookup,
                            billingYear: $billingYear,
                            headerStatusId: $headerStatusId,
                            itemStatusId: $itemStatusId,
                            lookupItems: $lookupItems,
                            property: $property,
                            homeownerProfileId: $homeownerProfile->id,
                            associationDueTypeId: $associationDueTypeId,
                        );
                    }
                }
            });
    }

    private function createYearlyDueForProperty(
        AssociationDueLookup $lookup,
        int $billingYear,
        ?int $headerStatusId,
        ?int $itemStatusId,
        $lookupItems,
        Property $property,
        int $homeownerProfileId,
        ?int $associationDueTypeId,
    ): void {
        $totalAmount = $lookupItems->sum('amount');

        $associationDue = AssociationDue::updateOrCreate(
            [
                'property_id' => $property->id,
                'billing_year' => $billingYear,
            ],
            [
                'homeowner_profile_id' => $homeownerProfileId,
                'association_due_lookup_id' => $lookup->id,
                'association_due_type_id' => $associationDueTypeId,
                'association_due_status_id' => $headerStatusId,
                'reference_no' => $this->makeReferenceNo($property->id, $billingYear),
                'subtotal_amount' => $totalAmount,
                'discount_amount' => 0,
                'penalty_amount' => 0,
                'total_amount' => $totalAmount,
                'paid_amount' => 0,
                'balance_amount' => $totalAmount,
                'notes' => "Auto-generated {$billingYear} association dues.",
            ]
        );

        foreach ($lookupItems as $lookupItem) {
            $associationDue->items()->updateOrCreate(
                [
                    'association_due_lookup_item_id' => $lookupItem->id,
                ],
                [
                    'association_due_item_status_id' => $itemStatusId,
                    'billing_month' => $lookupItem->billing_month,
                    'month_name' => $lookupItem->month_name,
                    'description' => "{$lookupItem->month_name} {$billingYear} Association Dues",
                    'due_date' => $lookupItem->due_date,
                    'amount' => $lookupItem->amount,
                    'paid_amount' => 0,
                    'balance_amount' => $lookupItem->amount,
                ]
            );
        }
    }

    private function makeReferenceNo(int $propertyId, int $billingYear): string
    {
        return 'AD-' . $billingYear . '-' . str_pad((string) $propertyId, 6, '0', STR_PAD_LEFT);
    }
}
