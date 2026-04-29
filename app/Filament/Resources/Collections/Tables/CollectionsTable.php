<?php

namespace App\Filament\Resources\Collections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CollectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref No.')
                    ->searchable(),

                TextColumn::make('external_reference_no')
                    ->label('Payment Ref.')
                    ->searchable(),

                TextColumn::make('homeownerProfile.name')
                    ->label('Homeowner')
                    ->searchable(),

                TextColumn::make('property.id')
                    ->label('Property')
                    ->formatStateUsing(
                        fn($record) => $record->property?->name ?? $record->property?->block_lot ?? 'Property #' . $record->property_id
                    ),

                TextColumn::make('paymentMethod.name')
                    ->label('Method')
                    ->badge(),

                TextColumn::make('amount')
                    ->money('PHP'),

                TextColumn::make('paymentStatus.name')
                    ->label('Status')
                    ->badge()
                    ->color(fn($record) => $record->paymentStatus?->color ?? 'gray'),

                TextColumn::make('bankAccount.name')
                    ->label('Bank/Cash'),

                TextColumn::make('paid_date')
                    ->date(),

                TextColumn::make('verified_at')
                    ->dateTime()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('payment_status_id')
                    ->label('Status')
                    ->relationship('paymentStatus', 'name'),

                SelectFilter::make('payment_method_id')
                    ->label('Method')
                    ->relationship('paymentMethod', 'name'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
