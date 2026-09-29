<?php

namespace App\Filament\Seller\Resources\FlashSales\Pages;

use App\Filament\Seller\Resources\FlashSales\FlashSaleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFlashSale extends EditRecord
{
    protected static string $resource = FlashSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
