<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use Filament\Support\Icons\Heroicon;


class CommunityHeatMap extends Page
{
    protected string $view = 'filament.pages.community-heat-map';

    protected static ?string $title = 'Community Heat Map';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    // public static function canAccess(): bool
    // {
    //     if (auth()->user()?->hasAnyRole(['super_admin', 'company_owner'])) {
    //         return true;
    //     }
    //     return false;
    // }



    public static function getNavigationSort(): ?int
    {
        return 210;
    }

    public static function getNavigationGroup(): ?string
    {
        return "Community";
    }
}
