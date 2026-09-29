<?php

namespace App\Filament\Seller\Resources\FlashSales\Pages;

use App\Filament\Seller\Resources\FlashSales\FlashSaleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFlashSales extends ListRecords
{
    protected static string $resource = FlashSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('⚡ New Flash Sale Request'),
        ];
    }
}
