<?php

namespace App\Filament\Resources\PaymentMethods\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Payment Method')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),

                    Toggle::make('is_active')
                        ->default(true),
                ]),
        ]);
    }
}