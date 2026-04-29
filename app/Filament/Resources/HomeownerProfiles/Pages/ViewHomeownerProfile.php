<?php

namespace App\Filament\Resources\HomeownerProfiles\Pages;

use App\Filament\Resources\HomeownerProfiles\HomeownerProfileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHomeownerProfile extends ViewRecord
{
    protected static string $resource = HomeownerProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
