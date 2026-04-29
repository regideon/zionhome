<?php

namespace App\Filament\Resources\Feedback\Tables;

use App\Models\Feedback;
use App\Models\FeedbackStatus;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FeedbackTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref No.')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->sortable(),

                IconColumn::make('is_emergency')
                    ->label('Emergency')
                    ->boolean()
                    ->trueIcon(Heroicon::ExclamationCircle)
                    ->falseIcon(Heroicon::OutlinedMinusCircle)
                    ->trueColor('danger')
                    ->falseColor('gray'),

                TextColumn::make('message')
                    ->searchable()
                    ->limit(90)
                    ->tooltip(fn($record) => $record->title),

                TextColumn::make('type.name')
                    ->label('Type')
                    ->badge()
                    ->color(fn($record) => $record->type?->color ?? 'gray'),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color(fn($record) => $record->category?->color ?? 'gray'),

                TextColumn::make('priority.name')
                    ->label('Priority')
                    ->badge()
                    ->color(fn($record) => $record->priority?->color ?? 'gray'),

                TextColumn::make('status.name')
                    ->label('Status')
                    ->badge()
                    ->color(fn($record) => $record->status?->color ?? 'gray'),

                TextColumn::make('user.name')
                    ->label('Submitted By')
                    ->searchable(),

                TextColumn::make('assignedUser.name')
                    ->label('Assigned To')
                    ->placeholder('—'),



                IconColumn::make('is_public')
                    ->label('Public')
                    ->boolean(),

                TextColumn::make('submitted_at')
                    ->label('Submitted')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('feedback_type_id')
                    ->label('Type')
                    ->relationship('type', 'name'),

                SelectFilter::make('feedback_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),

                SelectFilter::make('feedback_status_id')
                    ->label('Status')
                    ->relationship('status', 'name'),

                SelectFilter::make('feedback_priority_id')
                    ->label('Priority')
                    ->relationship('priority', 'name'),

                TernaryFilter::make('is_emergency')
                    ->label('Emergency'),

                TernaryFilter::make('is_public')
                    ->label('Public'),
            ])
            ->recordActions([
                EditAction::make(),

                Action::make('assign')
                    ->label('Assign')
                    ->icon(Heroicon::OutlinedUserPlus)
                    ->color('warning')
                    ->modalHeading('Assign Feedback')
                    ->schema([
                        Select::make('assigned_to')
                            ->label('Assign To')
                            ->relationship('assignedUser', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('feedback_status_id')
                            ->label('Update Status')
                            ->relationship('status', 'name')
                            ->default(fn() => FeedbackStatus::where('name', 'Assigned')->value('id'))
                            ->required(),
                    ])
                    ->action(function (Feedback $record, array $data) {
                        $record->update([
                            'assigned_to'        => $data['assigned_to'],
                            'feedback_status_id' => $data['feedback_status_id'],
                            'assigned_at'        => now(),
                        ]);

                        Notification::make()->title('Feedback assigned')->success()->send();
                    })
                    ->visible(fn(Feedback $record) => $record->assignedUser === null),

                Action::make('resolve')
                    ->label('Resolve')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Resolve Feedback')
                    ->modalDescription('Mark this feedback as resolved?')
                    ->action(function (Feedback $record) {
                        $record->update([
                            'feedback_status_id' => FeedbackStatus::where('name', 'Resolved')->value('id'),
                            'resolved_at'        => now(),
                        ]);

                        Notification::make()->title('Marked as resolved')->success()->send();
                    })
                    ->visible(fn(Feedback $record) => ! in_array($record->status?->name, ['Resolved', 'Closed', 'Cancelled'])),

                Action::make('close')
                    ->label('Close')
                    ->icon(Heroicon::OutlinedXCircle)
                    ->color('gray')
                    ->requiresConfirmation()
                    ->action(function (Feedback $record) {
                        $record->update([
                            'feedback_status_id' => FeedbackStatus::where('name', 'Closed')->value('id'),
                            'closed_at'          => now(),
                        ]);

                        Notification::make()->title('Feedback closed')->send();
                    })
                    ->visible(fn(Feedback $record) => ! in_array($record->status?->name, ['Closed', 'Cancelled'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('submitted_at', 'desc');
    }
}
