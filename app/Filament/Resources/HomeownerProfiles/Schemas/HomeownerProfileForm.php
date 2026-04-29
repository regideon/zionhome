<?php

namespace App\Filament\Resources\HomeownerProfiles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class HomeownerProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Login / User Account')
                    ->description('This is the linked user account of the homeowner.')
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->unique('users', 'email')
                                    ->maxLength(255),

                                TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->default('password')
                                    ->required()
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                            ]),
                    ]),

                Section::make('Homeowner Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('homeowner_code')
                            ->label('Homeowner Code')
                            ->placeholder('HO-0000001')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('contact_number')
                            ->label('Contact Number')
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('alternate_contact_number')
                            ->label('Alternate Contact Number')
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('billing_address')
                            ->label('Billing Address')
                            ->columnSpanFull(),

                        TextInput::make('permanent_address')
                            ->label('Permanent Address')
                            ->columnSpanFull(),
                    ]),

                Section::make('Emergency Contact')
                    ->columns(2)
                    ->schema([
                        TextInput::make('emergency_contact_name')
                            ->label('Emergency Contact Name')
                            ->maxLength(255),

                        TextInput::make('emergency_contact_number')
                            ->label('Emergency Contact Number')
                            ->tel()
                            ->maxLength(255),
                    ]),

                Section::make('Status')
                    ->schema([
                        Select::make('is_active')
                            ->label('Active?')
                            ->options([
                                1 => 'Yes',
                                0 => 'No',
                            ])
                            ->default(1)
                            ->required(),
                    ]),
            ]);
    }
}
