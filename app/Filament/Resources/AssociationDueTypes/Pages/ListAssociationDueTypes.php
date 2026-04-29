<?php

namespace App\Filament\Resources\AssociationDueTypes\Pages;

use App\Filament\Resources\AssociationDueTypes\AssociationDueTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssociationDueTypes extends ListRecords
{
    protected static string $resource = AssociationDueTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
