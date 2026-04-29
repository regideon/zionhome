<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = "Command Center";

    public function mount(): void
    {
        if (auth()->user()?->hasAnyRole(['worker', 'foreman'])) {
        }
    }
}
