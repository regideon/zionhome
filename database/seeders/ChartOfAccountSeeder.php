<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChartOfAccountSeeder extends Seeder
{
    public function run(): void
    {
        // SEE database/seeders/FinancialSeeder.php
        // account_types: 1=Asset, 2=Liability, 3=Equity, 4=Income, 5=Expense
        /*
        $accounts = [
            // Assets
            ['code' => '1000', 'name' => 'Assets',                     'account_type_id' => 1],
            ['code' => '1010', 'name' => 'Cash on Hand',               'account_type_id' => 1],
            ['code' => '1020', 'name' => 'Cash in Bank',               'account_type_id' => 1],
            ['code' => '1030', 'name' => 'GCash / E-Wallet',           'account_type_id' => 1],
            ['code' => '1100', 'name' => 'Accounts Receivable – Dues', 'account_type_id' => 1],

            // Liabilities
            ['code' => '2000', 'name' => 'Liabilities',                'account_type_id' => 2],
            ['code' => '2010', 'name' => 'Accounts Payable',           'account_type_id' => 2],
            ['code' => '2100', 'name' => 'Deferred Revenue',           'account_type_id' => 2],

            // Equity
            ['code' => '3000', 'name' => 'HOA Fund / Equity',          'account_type_id' => 3],
            ['code' => '3010', 'name' => 'Retained Surplus',           'account_type_id' => 3],

            // Income
            ['code' => '4000', 'name' => 'Income',                     'account_type_id' => 4],
            ['code' => '4010', 'name' => 'HOA Dues Revenue',           'account_type_id' => 4],
            ['code' => '4020', 'name' => 'Association Dues',           'account_type_id' => 4],
            ['code' => '4030', 'name' => 'Penalty / Late Fees',        'account_type_id' => 4],
            ['code' => '4040', 'name' => 'Gate Pass Fees',             'account_type_id' => 4],
            ['code' => '4050', 'name' => 'Amenity Fees',               'account_type_id' => 4],
            ['code' => '4090', 'name' => 'Other Income',               'account_type_id' => 4],

            // Expenses
            ['code' => '5000', 'name' => 'Expenses',                   'account_type_id' => 5],
            ['code' => '5010', 'name' => 'Salaries & Wages',           'account_type_id' => 5],
            ['code' => '5020', 'name' => 'Utilities',                  'account_type_id' => 5],
            ['code' => '5030', 'name' => 'Maintenance & Repairs',      'account_type_id' => 5],
            ['code' => '5040', 'name' => 'Administrative Expenses',    'account_type_id' => 5],
            ['code' => '5050', 'name' => 'Security Services',          'account_type_id' => 5],
            ['code' => '5090', 'name' => 'Other Expenses',             'account_type_id' => 5],
        ];

        foreach ($accounts as $account) {
            ChartOfAccount::firstOrCreate(
                ['code' => $account['code']],
                $account
            );
        }
            */
    }
}
