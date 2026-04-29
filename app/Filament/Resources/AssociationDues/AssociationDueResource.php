<?php

namespace App\Filament\Resources\AssociationDues;

use App\Filament\Resources\AssociationDues\Pages\CreateAssociationDue;
use App\Filament\Resources\AssociationDues\Pages\EditAssociationDue;
use App\Filament\Resources\AssociationDues\Pages\ListAssociationDues;
use App\Filament\Resources\AssociationDues\Schemas\AssociationDueForm;
use App\Filament\Resources\AssociationDues\Tables\AssociationDuesTable;
use App\Models\AssociationDue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AssociationDueResource extends Resource
{
    protected static ?string $model = AssociationDue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static ?string $recordTitleAttribute = 'name';


    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['items.status', 'property', 'homeownerProfile', 'status', 'type']);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Finance';
    }
    public static function getNavigationLabel(): string
    {
        return 'Association Dues';
    }
    public static function getModelLabel(): string
    {
        return 'Association Due';
    }
    public static function getNavigationSort(): ?int
    {
        return 500;
    }



    public static function form(Schema $schema): Schema
    {
        return AssociationDueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssociationDuesTable::configure($table);
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
            'index' => ListAssociationDues::route('/'),
            'create' => CreateAssociationDue::route('/create'),
            'edit' => EditAssociationDue::route('/{record}/edit'),
        ];
    }
}
