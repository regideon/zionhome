<?php

namespace App\Filament\Resources\BankAccounts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BankAccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('type')
                    ->badge(),

                TextColumn::make('bank_name')
                    ->searchable(),

                TextColumn::make('account_number')
                    ->searchable(),

                TextColumn::make('chartOfAccount.name')
                    ->label('Account'),

                TextColumn::make('opening_balance')
                    ->money('PHP'),

                IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
