<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Review Details')
                    ->icon(Heroicon::ChatBubbleLeftRight)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Customer'),
                        TextEntry::make('product.name')
                            ->label('Product'),
                        TextEntry::make('orderItem.order_id')
                            ->label('Order #'),
                        TextInput::make('rating')
                            ->label('Rating')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->required(),
                        Textarea::make('comment')
                            ->label('Comment')
                            ->required()
                            ->maxLength(1000)
                            ->rows(5)
                            ->columnSpanFull(),
                    ])->columns(2),
            ])->columns(1);
    }
}
