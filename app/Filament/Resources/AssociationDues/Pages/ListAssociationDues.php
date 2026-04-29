<?php

namespace App\Filament\Resources\AssociationDues\Pages;

use App\Filament\Resources\AssociationDues\AssociationDueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssociationDues extends ListRecords
{
    protected static string $resource = AssociationDueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
