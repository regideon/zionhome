<?php

namespace App\Filament\Resources\Vendors\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VendorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Vendor Information')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),

                    TextInput::make('contact_person'),

                    TextInput::make('contact_number'),

                    TextInput::make('email')
                        ->email(),

                    Textarea::make('address')
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->default(true),
                ]),
        ]);
    }
}