<?php

namespace App\Filament\Seller\Resources\FlashSales\Pages;

use App\Filament\Seller\Resources\FlashSales\FlashSaleResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFlashSale extends CreateRecord
{
    protected static string $resource = FlashSaleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['seller_id'] = Auth::guard('vendor')->id();
        $data['sold_quantity'] = 0;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
