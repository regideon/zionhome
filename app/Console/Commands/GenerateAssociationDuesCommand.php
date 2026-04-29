<?php

namespace App\Console\Commands;

use App\Services\AssociationDueGeneratorService;
use Illuminate\Console\Command;

class GenerateAssociationDuesCommand extends Command
{
    /**
     * php artisan zionhome:generate-association-dues 2026 --amount=1000 --due-day=15
     * 
     * Or publish immediately
     * php artisan zionhome:generate-association-dues 2026 --amount=1000 --due-day=15 --publish
     */
    protected $signature = 'zionhome:generate-association-dues
        {year? : Billing year to generate}
        {--amount=1000 : Monthly association due amount}
        {--due-day=15 : Monthly due day}
        {--publish : Publish immediately as unpaid instead of draft items}';

    protected $description = 'Generate yearly association dues lookup and monthly due items for all active properties.';

    public function handle(AssociationDueGeneratorService $generator): int
    {
        $year = (int) ($this->argument('year') ?: now()->addYear()->year);
        $amount = (float) $this->option('amount');
        $dueDay = (int) $this->option('due-day');
        $publish = (bool) $this->option('publish');

        $lookup = $generator->generateForYear(
            billingYear: $year,
            monthlyAmount: $amount,
            dueDay: $dueDay,
            publish: $publish
        );

        $this->info("Association dues generated for {$lookup->billing_year}.");

        return self::SUCCESS;
    }
}
