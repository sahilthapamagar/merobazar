<?php

namespace App\Filament\Seller\Resources\Reviews;

use App\Filament\Seller\Resources\Reviews\Pages\EditReview;
use App\Filament\Seller\Resources\Reviews\Pages\ListReviews;
use App\Filament\Seller\Resources\Reviews\Schemas\ReviewForm;
use App\Filament\Seller\Resources\Reviews\Tables\ReviewsTable;
use App\Models\Review;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Override;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;

    protected static ?int $navigationSort = 4;

    #[Override]
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('product', fn (Builder $query) => $query->where('seller_id', Auth::guard('vendor')->id()));
    }

    public static function getRecordTitle(?Model $record): ?string
    {
        return $record ? 'Review #' . $record->id : null;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['user.name', 'product.name', 'comment'];
    }

    public static function form(Schema $schema): Schema
    {
        return ReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReviews::route('/'),
            'edit' => EditReview::route('/{record}/edit'),
        ];
    }
}
