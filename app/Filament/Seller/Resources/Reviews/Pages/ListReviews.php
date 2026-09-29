<?php

namespace App\Filament\Seller\Resources\Reviews\Pages;

use App\Filament\Seller\Resources\Reviews\ReviewResource;
use Filament\Resources\Pages\ListRecords;

class ListReviews extends ListRecords
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
