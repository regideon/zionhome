<?php

namespace App\Filament\Resources\Feedback;

use App\Filament\Resources\Feedback\Pages\CreateFeedback;
use App\Filament\Resources\Feedback\Pages\EditFeedback;
use App\Filament\Resources\Feedback\Pages\ListFeedback;
use App\Filament\Resources\Feedback\Schemas\FeedbackForm;
use App\Filament\Resources\Feedback\Tables\FeedbackTable;
use App\Models\Feedback;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftEllipsis;

    protected static ?string $recordTitleAttribute = 'reference_no';

    public static function getNavigationGroup(): ?string
    {
        return 'Community';
    }

    public static function getNavigationLabel(): string
    {
        return 'Concerns & Feedback';
    }

    public static function getModelLabel(): string
    {
        return 'Concern & Feedback';
    }

    public static function getNavigationSort(): ?int
    {
        return 200;
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['type', 'category', 'status', 'priority', 'user', 'assignedUser']);
    }

    public static function form(Schema $schema): Schema
    {
        return FeedbackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeedbackTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListFeedback::route('/'),
            'create' => CreateFeedback::route('/create'),
            'edit'   => EditFeedback::route('/{record}/edit'),
        ];
    }
}
