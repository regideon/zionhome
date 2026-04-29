<?php

namespace App\Filament\Resources\HomeownerProfiles;

use App\Filament\Resources\HomeownerProfiles\Pages\CreateHomeownerProfile;
use App\Filament\Resources\HomeownerProfiles\Pages\EditHomeownerProfile;
use App\Filament\Resources\HomeownerProfiles\Pages\ListHomeownerProfiles;
use App\Filament\Resources\HomeownerProfiles\Pages\ViewHomeownerProfile;
use App\Filament\Resources\HomeownerProfiles\Schemas\HomeownerProfileForm;
use App\Filament\Resources\HomeownerProfiles\Schemas\HomeownerProfileInfolist;
use App\Filament\Resources\HomeownerProfiles\Tables\HomeownerProfilesTable;
use App\Models\HomeownerProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeownerProfileResource extends Resource
{
    protected static ?string $model = HomeownerProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'homeowner_code';


    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery();
    }
    public static function getNavigationGroup(): ?string
    {
        return 'Properties';
    }
    public static function getNavigationLabel(): string
    {
        return 'Homeowners';
    }
    public static function getModelLabel(): string
    {
        return 'Homeowner';
    }
    public static function getNavigationSort(): ?int
    {
        return 710;
    }



    public static function form(Schema $schema): Schema
    {
        return HomeownerProfileForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HomeownerProfileInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeownerProfilesTable::configure($table);
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
            'index' => ListHomeownerProfiles::route('/'),
            'create' => CreateHomeownerProfile::route('/create'),
            // 'view' => ViewHomeownerProfile::route('/{record}'),
            'edit' => EditHomeownerProfile::route('/{record}/edit'),
        ];
    }
}
