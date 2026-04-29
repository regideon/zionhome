<?php

namespace App\Filament\Resources\JournalEntries\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JournalEntryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Journal Entry')
                ->columns(4)
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('reference_no')->label('Ref No.'),
                    TextEntry::make('transaction.reference_no')->label('Transaction'),
                    TextEntry::make('entry_date')->date(),
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn($state) => match ($state) {
                            'POSTED' => 'success',
                            'VOIDED' => 'danger',
                            default  => 'gray',
                        }),
                    TextEntry::make('description')->columnSpan(2),
                    TextEntry::make('posted_at')->dateTime()->label('Posted At'),
                    TextEntry::make('poster.name')->label('Posted By'),
                ]),

            Section::make('Journal Entry Lines')
                ->columnSpanFull()
                ->schema([
                    RepeatableEntry::make('lines')
                        ->schema([
                            TextEntry::make('account.code')->label('Code'),
                            TextEntry::make('account.name')->label('Account'),
                            TextEntry::make('description'),
                            TextEntry::make('debit')->money('PHP'),
                            TextEntry::make('credit')->money('PHP'),
                        ])
                        ->columns(5),
                ]),

        ]);
    }
}
