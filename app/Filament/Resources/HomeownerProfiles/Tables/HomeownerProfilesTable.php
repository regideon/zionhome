<?php

namespace App\Filament\Resources\HomeownerProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomeownerProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('homeowner_code')
                    ->label('Code')
                    ->searchable()
                    ->color('primary')
                    ->weight(FontWeight::Bold)
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Homeowner')
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('contact_number')
                    ->label('Contact')
                    ->searchable(),

                TextColumn::make('billing_address')
                    ->label('Billing Address')
                    ->limit(40)
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
