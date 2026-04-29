<?php

namespace App\Filament\Resources\Expenses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref No.')
                    ->searchable(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge(),

                TextColumn::make('vendor.name')
                    ->label('Vendor')
                    ->searchable(),

                TextColumn::make('total_amount')
                    ->money('PHP'),

                TextColumn::make('paid_amount')
                    ->money('PHP'),

                TextColumn::make('balance_amount')
                    ->money('PHP'),

                TextColumn::make('status.name')
                    ->badge()
                    ->color(fn ($record) => $record->status?->color ?? 'gray'),

                TextColumn::make('bankAccount.name')
                    ->label('Paid From'),

                TextColumn::make('expense_date')
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('expense_status_id')
                    ->label('Status')
                    ->relationship('status', 'name'),

                SelectFilter::make('expense_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('expense_date', 'desc');
    }
}