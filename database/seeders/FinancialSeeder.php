<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\AssociationDueStatus;
use App\Models\AssociationDueType;
use App\Models\BankAccount;
use App\Models\ChartOfAccount;
use App\Models\ExpenseCategory;
use App\Models\ExpenseStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AssociationDueItemStatus;

/**
 * After run this seeder, run the following command:
 * php artisan zionhome:generate-association-dues 2026 --amount=1000 --due-day=15
 */
class FinancialSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('expense_categories')->truncate();
        DB::table('expense_statuses')->truncate();
        DB::table('payment_statuses')->truncate();
        DB::table('payment_methods')->truncate();
        DB::table('association_due_types')->truncate();
        DB::table('association_due_statuses')->truncate();
        DB::table('bank_accounts')->truncate();
        DB::table('chart_of_accounts')->truncate();
        DB::table('account_types')->truncate();
        DB::table('association_due_item_statuses')->truncate();

        DB::table('association_dues')->truncate();
        DB::table('association_due_items')->truncate();
        DB::table('association_due_lookups')->truncate();
        DB::table('association_due_lookup_items')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $asset = AccountType::firstOrCreate(['name' => 'Asset'], ['normal_balance' => 'debit']);
        $liability = AccountType::firstOrCreate(['name' => 'Liability'], ['normal_balance' => 'credit']);
        $equity = AccountType::firstOrCreate(['name' => 'Equity'], ['normal_balance' => 'credit']);
        $income = AccountType::firstOrCreate(['name' => 'Income'], ['normal_balance' => 'credit']);
        $expense = AccountType::firstOrCreate(['name' => 'Expense'], ['normal_balance' => 'debit']);

        $accounts = [
            ['1000', 'Cash on Hand', $asset->id],
            ['1010', 'Cash in Bank', $asset->id],
            ['1020', 'GCash / E-Wallet', $asset->id],
            ['1100', 'Accounts Receivable', $asset->id],

            ['2000', 'Accounts Payable', $liability->id],
            ['2100', 'Accrued Expenses', $liability->id],
            ['2200', 'Payroll Payable', $liability->id],
            ['2210', 'SSS Payable', $liability->id],
            ['2220', 'PhilHealth Payable', $liability->id],
            ['2230', 'Pag-IBIG Payable', $liability->id],
            ['2240', 'Withholding Tax Payable', $liability->id],

            ['3000', 'HOA Fund Balance', $equity->id],
            ['3100', 'Retained Surplus', $equity->id],

            ['4000', 'Association Dues Income', $income->id],
            ['4010', 'Clubhouse Rental Income', $income->id],
            ['4020', 'Amenity Rental Income', $income->id],
            ['4030', 'Vehicle Sticker Income', $income->id],
            ['4040', 'Penalty Income', $income->id],
            ['4050', 'Document Processing Income', $income->id],
            ['4060', 'Special Assessment Income', $income->id],
            ['4090', 'Other Income', $income->id],

            ['5000', 'Repairs and Maintenance Expense', $expense->id],
            ['5010', 'Security Expense', $expense->id],
            ['5020', 'Garbage Collection Expense', $expense->id],
            ['5030', 'Utilities Expense', $expense->id],
            ['5040', 'Materials and Supplies Expense', $expense->id],
            ['5050', 'Professional / Resource Person Fee', $expense->id],
            ['5060', 'Admin and Office Expense', $expense->id],
            ['5070', 'Event Expense', $expense->id],
            ['5080', 'Bank Charges', $expense->id],
            ['5090', 'Miscellaneous Expense', $expense->id],
            ['5100', 'Payroll Expense', $expense->id],
        ];

        foreach ($accounts as [$code, $name, $typeId]) {
            ChartOfAccount::firstOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'account_type_id' => $typeId,
                    'is_active' => true,
                ]
            );
        }

        BankAccount::firstOrCreate(
            ['name' => 'Cash on Hand'],
            [
                'type' => 'cash',
                'chart_of_account_id' => ChartOfAccount::where('code', '1000')->value('id'),
                'opening_balance' => 0,
            ]
        );

        BankAccount::firstOrCreate(
            ['name' => 'Main HOA Bank Account'],
            [
                'type' => 'bank',
                'bank_name' => 'BDO',
                'chart_of_account_id' => ChartOfAccount::where('code', '1010')->value('id'),
                'opening_balance' => 0,
            ]
        );

        BankAccount::firstOrCreate(
            ['name' => 'GCash Account'],
            [
                'type' => 'gcash',
                'bank_name' => 'GCash',
                'chart_of_account_id' => ChartOfAccount::where('code', '1020')->value('id'),
                'opening_balance' => 0,
            ]
        );

        AssociationDueStatus::firstOrCreate(['name' => 'Unpaid'], ['color' => 'danger']);
        AssociationDueStatus::firstOrCreate(['name' => 'Partial'], ['color' => 'warning']);
        AssociationDueStatus::firstOrCreate(['name' => 'Paid'], ['color' => 'success']);
        AssociationDueStatus::firstOrCreate(['name' => 'Overdue'], ['color' => 'danger']);
        AssociationDueStatus::firstOrCreate(['name' => 'Cancelled'], ['color' => 'gray']);

        AssociationDueType::firstOrCreate(
            ['name' => 'Monthly Association Dues'],
            ['income_account_id' => ChartOfAccount::where('code', '4000')->value('id')]
        );

        AssociationDueType::firstOrCreate(
            ['name' => 'Yearly Association Dues'],
            ['income_account_id' => ChartOfAccount::where('code', '4000')->value('id')]
        );

        AssociationDueType::firstOrCreate(
            ['name' => 'Penalty'],
            ['income_account_id' => ChartOfAccount::where('code', '4040')->value('id')]
        );

        AssociationDueType::firstOrCreate(
            ['name' => 'Special Assessment'],
            ['income_account_id' => ChartOfAccount::where('code', '4060')->value('id')]
        );

        PaymentMethod::firstOrCreate(['name' => 'Cash']);
        PaymentMethod::firstOrCreate(['name' => 'Bank Transfer']);
        PaymentMethod::firstOrCreate(['name' => 'GCash']);
        PaymentMethod::firstOrCreate(['name' => 'Check']);

        PaymentStatus::firstOrCreate(['name' => 'Pending Verification'], ['color' => 'warning']);
        PaymentStatus::firstOrCreate(['name' => 'Verified'], ['color' => 'success']);
        PaymentStatus::firstOrCreate(['name' => 'Rejected'], ['color' => 'danger']);
        PaymentStatus::firstOrCreate(['name' => 'Cancelled'], ['color' => 'gray']);

        ExpenseStatus::firstOrCreate(['name' => 'Unpaid'], ['color' => 'danger']);
        ExpenseStatus::firstOrCreate(['name' => 'Paid'], ['color' => 'success']);
        ExpenseStatus::firstOrCreate(['name' => 'Partial'], ['color' => 'warning']);
        ExpenseStatus::firstOrCreate(['name' => 'Cancelled'], ['color' => 'gray']);

        $expenseCategories = [
            ['Repairs and Maintenance', '5000'],
            ['Security Expense', '5010'],
            ['Garbage Collection', '5020'],
            ['Utilities', '5030'],
            ['Materials and Supplies', '5040'],
            ['Professional / Resource Person Fee', '5050'],
            ['Admin and Office Expense', '5060'],
            ['Event Expense', '5070'],
            ['Bank Charges', '5080'],
            ['Miscellaneous Expense', '5090'],
            ['Payroll Expense', '5100'],
        ];

        foreach ($expenseCategories as [$name, $accountCode]) {
            ExpenseCategory::firstOrCreate(
                ['name' => $name],
                [
                    'expense_account_id' => ChartOfAccount::where('code', $accountCode)->value('id'),
                    'is_active' => true,
                ]
            );
        }

        AssociationDueItemStatus::firstOrCreate(['name' => 'Draft'], ['color' => 'gray']);
        AssociationDueItemStatus::firstOrCreate(['name' => 'Unpaid'], ['color' => 'danger']);
        AssociationDueItemStatus::firstOrCreate(['name' => 'Partial'], ['color' => 'warning']);
        AssociationDueItemStatus::firstOrCreate(['name' => 'Paid'], ['color' => 'success']);
        AssociationDueItemStatus::firstOrCreate(['name' => 'Overdue'], ['color' => 'danger']);
        AssociationDueItemStatus::firstOrCreate(['name' => 'Waived'], ['color' => 'info']);
        AssociationDueItemStatus::firstOrCreate(['name' => 'Cancelled'], ['color' => 'gray']);
    }
}
