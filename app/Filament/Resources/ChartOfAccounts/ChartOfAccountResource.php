<?php

namespace App\Filament\Resources\ChartOfAccounts;

use App\Filament\Resources\ChartOfAccounts\Pages\CreateChartOfAccount;
use App\Filament\Resources\ChartOfAccounts\Pages\EditChartOfAccount;
use App\Filament\Resources\ChartOfAccounts\Pages\ListChartOfAccounts;
use App\Filament\Resources\ChartOfAccounts\Schemas\ChartOfAccountForm;
use App\Filament\Resources\ChartOfAccounts\Tables\ChartOfAccountsTable;
use App\Models\ChartOfAccount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ChartOfAccountResource extends Resource
{
    protected static ?string $model = ChartOfAccount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNumberedList;

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
        return 'Chart of Accounts';
    }
    public static function getModelLabel(): string
    {
        return 'Chart of Account';
    }
    public static function getNavigationSort(): ?int
    {
        return 570;
    }



    public static function form(Schema $schema): Schema
    {
        return ChartOfAccountForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChartOfAccountsTable::configure($table);
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
            'index' => ListChartOfAccounts::route('/'),
            'create' => CreateChartOfAccount::route('/create'),
            'edit' => EditChartOfAccount::route('/{record}/edit'),
        ];
    }
}
