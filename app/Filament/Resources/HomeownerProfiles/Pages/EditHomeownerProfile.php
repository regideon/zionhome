<?php

namespace App\Filament\Resources\HomeownerProfiles\Pages;

use App\Filament\Resources\HomeownerProfiles\HomeownerProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeownerProfile extends EditRecord
{
    protected static string $resource = HomeownerProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
