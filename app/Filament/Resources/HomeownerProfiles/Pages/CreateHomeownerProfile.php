<?php

namespace App\Filament\Resources\HomeownerProfiles\Pages;

use App\Filament\Resources\HomeownerProfiles\HomeownerProfileResource;
use Filament\Resources\Pages\CreateRecord;
use App\Support\ModuleReference;

class CreateHomeownerProfile extends CreateRecord
{
    protected static string $resource = HomeownerProfileResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['homeowner_code'] = ModuleReference::generate('homeowner');

        return $data;
    }
}
