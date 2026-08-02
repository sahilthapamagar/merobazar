<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
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
            ])->columns(1);
    }
}
