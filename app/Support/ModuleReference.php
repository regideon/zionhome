<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class ModuleReference
{
    protected static int $digits = 7;

    protected static array $registry = [
        'homeowner'       => ['table' => 'homeowner_profiles', 'column' => 'homeowner_code', 'prefix' => 'HO-'],
        'association_due' => [
            'table'  => 'association_dues',
            'column' => 'reference_no',
            'prefix' => 'DUE-',
        ],
        'expense' => [
            'table'  => 'expenses',
            'column' => 'module_reference_number',
            'prefix' => 'EXP-',
        ],
        'client_payment' => [
            'table'  => 'client_payments',
            'column' => 'module_reference_number',
            'prefix' => 'CP-',
        ],
        'payment' => [
            'table'  => 'payments',
            'column' => 'module_reference_number',
            'prefix' => 'PAY-',
        ],
        'transaction' => [
            'table'  => 'transactions',
            'column' => 'module_reference_number',
            'prefix' => 'TXN-',
        ],
        'transfer' => [
            'table'  => 'transactions',
            'column' => 'module_reference_number',
            'prefix' => 'TRF-',
        ],
        'payroll' => [
            'table'  => 'payrolls',
            'column' => 'module_reference_number',
            'prefix' => 'PRL-',
        ],
        'invoice' => [
            'table'  => 'invoices',
            'column' => 'module_reference_number',
            'prefix' => 'INV-',
        ],
        'journal' => [
            'table'  => 'journal_entries',
            'column' => 'entry_no',
            'prefix' => 'JE-',
        ],
        'change_request' => [
            'table'  => 'change_requests',
            'column' => 'module_reference_number',
            'prefix' => 'CR-',
        ],
        'cash_advance' => [
            'table'  => 'cash_advances',
            'column' => 'module_reference_number',
            'prefix' => 'CA-',
        ],
        'feedback' => [
            'table'  => 'feedbacks',
            'column' => 'reference_no',
            'prefix' => 'FB-',
        ],

    ];

    public static function generate(string $module): string
    {
        $config = static::$registry[$module] ?? null;

        if (! $config) {
            throw new \InvalidArgumentException(
                "ModuleReference: unknown module [{$module}]."
            );
        }

        $next = static::nextNumber($config['table'], $config['column'], $config['prefix']);

        return $config['prefix'] . str_pad($next, static::$digits, '0', STR_PAD_LEFT);
    }

    private static function nextNumber(string $table, string $column, string $prefix): int
    {
        $latest = DB::table($table)
            ->where($column, 'like', $prefix . '%')
            ->orderByDesc($column)
            ->value($column);

        if (! $latest) {
            return 1;
        }

        $number = (int) ltrim(substr($latest, strlen($prefix)), '0');

        return $number + 1;
    }
}
