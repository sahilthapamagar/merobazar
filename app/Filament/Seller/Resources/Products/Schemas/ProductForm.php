<?php

namespace App\Filament\Seller\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('discount')
                    ->label('Discount (%)')
                    ->prefix('%')
                    ->required()
                    ->numeric()
                    ->default(0),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Hidden::make('seller_id')
                    ->default(fn () => Auth::guard('vendor')->id()),

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
