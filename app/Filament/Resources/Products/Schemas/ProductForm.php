<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('stock')
                    ->required(),
                Select::make('seller_id')
                    ->relationship('seller', 'shop_name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Repeater::make('Product Variants')
                    ->relationship('productVarient')
                    ->defaultItems(0)
                    ->columnSpanFull()
                    ->grid(2)
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        TextInput::make('price')
                            ->prefix('Rs.')
                            ->required()
                            ->numeric(),
                        FileUpload::make('images')
                            ->multiple()
                            ->required(),
                    ]),

            ]);
    }
}
