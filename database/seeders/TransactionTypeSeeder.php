<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Collection',  'code' => 'COLLECTION'],
            ['name' => 'Payment',     'code' => 'PAYMENT'],
            ['name' => 'Refund',      'code' => 'REFUND'],
            ['name' => 'Transfer',    'code' => 'TRANSFER'],
            ['name' => 'Adjustment',  'code' => 'ADJUSTMENT'],
        ];

        foreach ($types as $type) {
            TransactionType::firstOrCreate(['code' => $type['code']], $type);
        }
    }
}
