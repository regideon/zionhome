<?php

namespace App\Filament\Resources\JournalEntries\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JournalEntriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref No.')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('transaction.reference_no')
                    ->label('Transaction')
                    ->searchable(),

                TextColumn::make('description')
                    ->limit(50),

                TextColumn::make('entry_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'POSTED' => 'success',
                        'VOIDED' => 'danger',
                        default  => 'gray',
                    }),

                TextColumn::make('lines_sum_debit')
                    ->label('Total Debit')
                    ->money('PHP')
                    ->sum('lines', 'debit'),

                TextColumn::make('lines_sum_credit')
                    ->label('Total Credit')
                    ->money('PHP')
                    ->sum('lines', 'credit'),

                TextColumn::make('posted_at')
                    ->label('Posted')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'DRAFT'  => 'Draft',
                        'POSTED' => 'Posted',
                        'VOIDED' => 'Voided',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->defaultSort('entry_date', 'desc');
    }
}
