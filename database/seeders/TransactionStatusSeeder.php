<?php

namespace Database\Seeders;

use App\Models\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Draft',   'code' => 'DRAFT'],
            ['name' => 'Pending', 'code' => 'PENDING'],
            ['name' => 'Posted',  'code' => 'POSTED'],
            ['name' => 'Voided',  'code' => 'VOIDED'],
        ];

        foreach ($statuses as $status) {
            TransactionStatus::firstOrCreate(['code' => $status['code']], $status);
        }
    }
}
