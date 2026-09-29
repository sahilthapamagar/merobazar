<?php

namespace App\Filament\Seller\Resources\FlashSales;

use App\Filament\Seller\Resources\FlashSales\Pages\CreateFlashSale;
use App\Filament\Seller\Resources\FlashSales\Pages\EditFlashSale;
use App\Filament\Seller\Resources\FlashSales\Pages\ListFlashSales;
use App\Filament\Seller\Resources\FlashSales\Schemas\FlashSaleForm;
use App\Filament\Seller\Resources\FlashSales\Tables\FlashSalesTable;
use App\Models\FlashSale;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Override;

class FlashSaleResource extends Resource
{
    protected static ?string $model = FlashSale::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Bolt;

    protected static ?string $navigationLabel = '⚡ Flash Sales';

    protected static ?string $modelLabel = 'Flash Sale';

    protected static ?string $pluralModelLabel = 'Flash Sales';

    protected static ?int $navigationSort = 3;

    #[Override]
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('seller_id', Auth::guard('vendor')->id());
    }

    public static function form(Schema $schema): Schema
    {
        return FlashSaleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FlashSalesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFlashSales::route('/'),
            'create' => CreateFlashSale::route('/create'),
            'edit' => EditFlashSale::route('/{record}/edit'),
        ];
    }
}
