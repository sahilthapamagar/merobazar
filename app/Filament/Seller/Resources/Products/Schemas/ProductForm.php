<?php

namespace App\Filament\Seller\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Product Information')
                            ->schema([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rs.'),
                                TextInput::make('discounted_price')
                                    ->numeric()
                                    ->prefix('Rs.')
                                    ->placeholder('Leave empty if no discount')
                                    ->rule('lt:price')
                                    ->helperText('Sale price shown to customers (must be lower than the regular price).'),
                                TextInput::make('title')
                                    ->required()
                                    ->columnSpanFull(),
                                Hidden::make('seller_id')
                                    ->default(auth()->guard('vendor')->id()),
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Section::make('Upload Images')
                            ->schema([
                                FileUpload::make('main_image')
                                    ->image()
                                    ->directory('products/images')
                                    ->acceptedFileTypes(
                                        [
                                            'image/jpeg',
                                            'image/png',
                                            'image/jpg',
                                        ]
                                    ),
                            ]),
                    ])->columns(2),

                Section::make('Product Description')
                    ->schema([
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(1),
                Section::make('Additional Images')
                    ->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->directory('products/images')
                            ->acceptedFileTypes(
                                [
                                    'image/jpeg',
                                    'image/png',
                                    'image/jpg',
                                ]
                            ),
                    ])->columns(1),
            ])->columns(1);
    }
}
