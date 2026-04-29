<?php

namespace App\Filament\Resources\AssociationDues\Pages;

use App\Filament\Resources\AssociationDues\AssociationDueResource;
use App\Support\ModuleReference;
use Filament\Resources\Pages\CreateRecord;

class CreateAssociationDue extends CreateRecord
{
    protected static string $resource = AssociationDueResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['reference_no'] = ModuleReference::generate('association_due');

        return $data;
    }
}
