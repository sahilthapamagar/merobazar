<?php

namespace App\Filament\Seller\Resources\FlashSales\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class FlashSaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Flash Sale Details')
                            ->description('Select a product and specify flash sale pricing and duration.')
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->options(function () {
                                        $sellerId = Auth::guard('vendor')->id();

                                        return Product::where('seller_id', $sellerId)
                                            ->get()
                                            ->mapWithKeys(fn (Product $p) => [$p->id => "{$p->name} (Normal Price: Rs. ".number_format($p->price, 2).')']);
                                    })
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($product = Product::find($state)) {
                                            $set('_normal_price', $product->price);
                                        }
                                    }),
                                Hidden::make('seller_id')
                                    ->default(fn () => Auth::guard('vendor')->id()),
                                TextInput::make('flash_price')
                                    ->label('Flash Sale Price (Rs.)')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rs.')
                                    ->rules([
                                        fn (callable $get) => function (string $attribute, $value, \Closure $fail) use ($get) {
                                            $productId = $get('product_id');
                                            $product = $productId ? Product::find($productId) : null;
                                            if ($product && (float) $value >= (float) $product->price) {
                                                $fail("Flash price must be less than the regular price (Rs. ".number_format($product->price, 2).').');
                                            }
                                        },
                                    ])
                                    ->helperText('Discounted price applied during the active flash sale window.'),
                                TextInput::make('flash_stock')
                                    ->label('Flash Stock (Quantity)')
                                    ->required()
                                    ->numeric()
                                    ->integer()
                                    ->minValue(1)
                                    ->default(10)
                                    ->helperText('Quantity reserved for this flash sale.'),
                                DateTimePicker::make('start_time')
                                    ->label('Start Date & Time')
                                    ->required()
                                    ->default(now())
                                    ->native(false),
                                DateTimePicker::make('end_time')
                                    ->label('End Date & Time')
                                    ->required()
                                    ->default(now()->addHours(24))
                                    ->native(false)
                                    ->after('start_time')
                                    ->helperText('Sale automatically expires at this time and reverts to normal price.'),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }
}
