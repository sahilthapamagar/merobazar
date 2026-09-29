<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use App\Models\OrderItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Details')
                    ->columns(2)
                    ->components([
                        TextEntry::make('user.name')
                            ->label('User'),
                        TextEntry::make('user.deliveryAddresses.contact')
                            ->label('User Contact'),
                        TextEntry::make('user.deliveryAddresses.address_detail')
                            ->label('User Address'),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending (Order Placed)',
                                'processing' => 'Processing (Order is being processed && On the way)',
                                'delivered' => 'Delivered (Order has been delivered)',
                                'cancelled' => 'Cancelled (Order has been cancelled)',
                            ])
                            ->default('pending')
                            ->required(),
                        TextEntry::make('seller.name')
                            ->label('Seller'),
                        TextEntry::make('seller.email')
                            ->label('Seller Email'),
                        TextInput::make('total_amount')
                            ->required()
                            ->numeric(),
                        Select::make('payment_method')
                            ->options(['cod' => 'Cod', 'khalti' => 'Khalti'])
                            ->required(),
                        TextInput::make('payment_status')
                            ->required()
                            ->default('pending'),
                    ]),
                Section::make('Order Items')
                    ->schema(function (?Order $record) {
                        return $record?->orderItems
                            ?->values()
                            ->map(function (OrderItem $item, int $index) {
                                return Grid::make(3)
                                    ->schema([
                                        TextEntry::make('product.name')
                                            ->label('Product')
                                            ->getStateUsing(fn () => $item->product?->name ?? '—'),
                                        TextInput::make('quantity')
                                            ->statePath("_order_item_qty_{$index}")
                                            ->numeric()
                                            ->minValue(1)
                                            ->disabled()
                                            ->dehydrated(false)
                                            ->formatStateUsing(fn () => $item->quantity),
                                        TextInput::make('amount')
                                            ->statePath("_order_item_amount_{$index}")
                                            ->numeric()
                                            ->prefix('Rs.')
                                            ->disabled()
                                            ->dehydrated(false)
                                            ->formatStateUsing(fn () => $item->amount),
                                    ]);
                            })
                            ->all() ?? [];
                    }),
            ])->columns(1);
    }
}
