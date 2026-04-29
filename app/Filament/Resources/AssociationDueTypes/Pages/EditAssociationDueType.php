<?php

namespace App\Filament\Resources\AssociationDueTypes\Pages;

use App\Filament\Resources\AssociationDueTypes\AssociationDueTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAssociationDueType extends EditRecord
{
    protected static string $resource = AssociationDueTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
