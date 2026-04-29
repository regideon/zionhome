<?php

namespace App\Filament\Resources\AssociationDueTypes;

use App\Filament\Resources\AssociationDueTypes\Pages\CreateAssociationDueType;
use App\Filament\Resources\AssociationDueTypes\Pages\EditAssociationDueType;
use App\Filament\Resources\AssociationDueTypes\Pages\ListAssociationDueTypes;
use App\Filament\Resources\AssociationDueTypes\Schemas\AssociationDueTypeForm;
use App\Filament\Resources\AssociationDueTypes\Tables\AssociationDueTypesTable;
use App\Models\AssociationDueType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AssociationDueTypeResource extends Resource
{
    protected static ?string $model = AssociationDueType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'name';


    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery();
    }
    public static function getNavigationGroup(): ?string
    {
        return 'Finance Setup';
    }
    public static function getNavigationLabel(): string
    {
        return 'Due Types';
    }
    public static function getModelLabel(): string
    {
        return 'Due Type';
    }
    public static function getNavigationSort(): ?int
    {
        return 550;
    }



    public static function form(Schema $schema): Schema
    {
        return AssociationDueTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssociationDueTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAssociationDueTypes::route('/'),
            'create' => CreateAssociationDueType::route('/create'),
            'edit' => EditAssociationDueType::route('/{record}/edit'),
        ];
    }
}
