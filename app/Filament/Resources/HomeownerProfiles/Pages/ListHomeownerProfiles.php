<?php

namespace App\Filament\Resources\HomeownerProfiles\Pages;

use App\Filament\Resources\HomeownerProfiles\HomeownerProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeownerProfiles extends ListRecords
{
    protected static string $resource = HomeownerProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
