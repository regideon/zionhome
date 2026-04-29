<?php

namespace App\Filament\Resources\Feedback\Schemas;

use App\Models\FeedbackStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Feedback Details')
                ->columns(4)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('reference_no')
                        ->label('Reference No.')
                        ->disabled()
                        ->dehydrated()
                        ->placeholder('Auto-generated'),

                    Select::make('feedback_type_id')
                        ->label('Type')
                        ->relationship('type', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('feedback_category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Select::make('feedback_priority_id')
                        ->label('Priority')
                        ->relationship('priority', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable(),
                ]),

            Section::make('Status & Assignment')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    Select::make('feedback_status_id')
                        ->label('Status')
                        ->relationship('status', 'name')
                        ->default(fn() => FeedbackStatus::where('name', 'Submitted')->value('id'))
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('assigned_to')
                        ->label('Assigned To')
                        ->relationship('assignedUser', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Select::make('user_id')
                        ->label('Submitted By')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable(),
                ]),

            Section::make('Flags')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    Toggle::make('is_emergency')
                        ->label('Emergency')
                        ->default(false),

                    Toggle::make('is_anonymous')
                        ->label('Anonymous Submission')
                        ->default(false),

                    Toggle::make('is_public')
                        ->label('Visible to Community')
                        ->default(false),
                ]),

            Section::make('Message')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('message')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                ]),

            Section::make('Location')
                ->columns(4)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('location_label')
                        ->label('Location Label')
                        ->nullable()
                        ->columnSpan(2),

                    TextInput::make('block_no')
                        ->label('Block No.')
                        ->nullable(),

                    TextInput::make('lot_no')
                        ->label('Lot No.')
                        ->nullable(),

                    Select::make('subdivision_phase_id')
                        ->label('Phase')
                        ->relationship('subdivisionPhase', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Select::make('street_id')
                        ->label('Street')
                        ->relationship('street', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Select::make('property_id')
                        ->label('Property')
                        ->relationship('property', 'id')
                        ->getOptionLabelFromRecordUsing(
                            fn($record) => $record->property_code ?? $record->block_lot ?? 'Property #' . $record->id
                        )
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Select::make('homeowner_profile_id')
                        ->label('Homeowner')
                        ->relationship(
                            name: 'homeownerProfile',
                            titleAttribute: 'homeowner_code',
                            modifyQueryUsing: fn($query) => $query->with('user'),
                        )
                        ->getOptionLabelFromRecordUsing(
                            fn($record) => trim(($record->user?->name . ' — ' ?? '') . ($record->homeowner_code ?? ''))
                        )
                        ->searchable()
                        ->preload()
                        ->nullable(),
                ]),

            Section::make('Timeline')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    DateTimePicker::make('submitted_at')
                        ->label('Submitted At')
                        ->default(now())
                        ->nullable(),

                    DateTimePicker::make('reviewed_at')
                        ->label('Reviewed At')
                        ->nullable(),

                    DateTimePicker::make('assigned_at')
                        ->label('Assigned At')
                        ->nullable(),

                    DateTimePicker::make('resolved_at')
                        ->label('Resolved At')
                        ->nullable(),

                    DateTimePicker::make('closed_at')
                        ->label('Closed At')
                        ->nullable(),
                ]),

            Section::make('Admin Notes')
                ->columnSpanFull()
                ->schema([
                    Textarea::make('admin_notes')
                        ->rows(3)
                        ->nullable()
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
