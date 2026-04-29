# ZionHome Financial Architecture

ZionHome is a subdivision / HOA management platform built using:

- Laravel 12
- Livewire
- Filament PHP 5
- MySQL
- Spatie Roles & Permissions

This document defines the financial architecture that Claude must always follow when generating code.

---

# Core Financial Principle

ZionHome uses a **billing + transaction architecture**

## Billing Records

These are records that represent money owed.

### Association Dues

Recurring homeowner dues

Examples:

- Monthly dues
- Yearly dues

Structure:

- association_due_lookups
- association_due_lookup_items
- association_dues
- association_due_items

Association dues are generated yearly.

Example:
2026 dues generate:

- 1 yearly association_due header
- 12 monthly association_due_items

Association dues are NOT actual payments.

---

## Community Charges

Non-recurring homeowner billings

Examples:

- Permit Fee
- Swimming Pool Fee
- Clubhouse Rental
- Basketball Court Fee
- Vehicle Sticker
- Gate Pass
- Document Request Fee
- Penalty
- Special Assessment
- Event Contribution
- Other One-Time Fee

Community charges are billing records only.

They are NOT payment records.

---

## Expenses

Money the HOA needs to pay.

Examples:

- Electric bill
- Security payroll (future)
- Repairs
- Maintenance
- Vendor payables

Expenses are payable records only.

They are NOT actual payment records.

---

# Single Source of Truth for Money Movement

ZionHome DOES NOT use Collections.

ZionHome uses:

# Transactions

Transactions represent ALL actual money movement.

Both:

- money in
- money out

must go through transactions.

---

# Money In Examples

- Association Dues Payment
- Community Charge Payment
- Donation
- Misc Income
- Rental Income
- Penalty Income

---

# Money Out Examples

- Expense Payment
- Vendor Payment
- Refund
- Maintenance Payment
- Utility Payment

---

# Important Rule

Never directly mark these modules as paid manually:

- association_due_items
- community_charges
- expenses

These modules should only be updated AFTER a verified transaction is created.

---

# Transaction Flow

## Association Dues Payment

Transaction created:

- linked to association_due_item

Once verified:

Update:

- association_due_items.paid_amount
- association_due_items.balance_amount
- association_due_item_status

Then recalculate:

- association_dues.paid_amount
- association_dues.balance_amount
- association_due_status

---

## Community Charge Payment

Transaction created:

- linked to community_charge

Once verified:

Update:

- community_charges.paid_amount
- community_charges.balance_amount
- community_charge_status

---

## Expense Payment

Transaction created:

- linked to expense

Once verified:

Update:

- expenses.paid_amount
- expenses.balance_amount
- expense_status

---

# Bank Accounts

Bank accounts represent:

- Cash
- Bank accounts
- GCash
- E-wallets

Transactions must reference where money enters or exits.

---

# Chart of Accounts

Chart of accounts is used for accounting mapping.

Keep accounting complexity hidden from HOA admins.

Use accounting tables internally only.

---

# Required Tables

Claude should follow these tables:

## Billing Tables

- association_due_lookups
- association_due_lookup_items
- association_dues
- association_due_items
- community_charges

---

## Expense Tables

- expenses
- expense_items
- vendors

---

## Transaction Tables

- transaction_types
- transaction_statuses
- transactions

---

## Accounting Tables

- chart_of_accounts
- bank_accounts

---

# transaction_types

Must support:

## Money In

- Association Dues Payment
- Community Charge Payment
- Donation
- Miscellaneous Income
- Rental Income
- Penalty Income

## Money Out

- Expense Payment
- Vendor Payment
- Refund
- Maintenance Payment
- Utility Payment

---

# transaction_statuses

Default statuses:

- Draft
- Pending Verification
- Verified
- Cancelled
- Failed

---

# Community Charge Types

Default seed data:

- Permit Fee
- Swimming Pool Fee
- Clubhouse Rental
- Basketball Court Fee
- Vehicle Sticker
- Gate Pass
- Document Request Fee
- Penalty
- Special Assessment
- Event Contribution
- Other One-Time Fee

---

# Community Charge Statuses

Default seed data:

- Draft
- Pending Payment
- Partial Paid
- Paid
- Cancelled
- Waived

---

# Development Rules

When generating Laravel code:

- always follow Filament PHP 5 architecture
- use separate:
    - Resource
    - Schemas
    - Tables
    - Pages

Never use old Filament structure.

---

# Filament Structure Example

```txt
Transactions/
├── TransactionResource.php
├── Pages/
├── Schemas/
│   └── TransactionForm.php
└── Tables/
    └── TransactionsTable.php
```
