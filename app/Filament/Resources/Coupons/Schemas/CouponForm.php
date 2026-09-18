<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Coupon')
                    ->columns(2)
                    ->components([
                        TextInput::make('code')
                            ->label('Code')
                            ->required()
                            ->maxLength(64)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),
                        TextInput::make('description')
                            ->label('Description')
                            ->maxLength(255),
                        Select::make('type')
                            ->label('Discount Type')
                            ->options([
                                'percent' => 'Percentage',
                                'fixed' => 'Fixed Amount',
                            ])
                            ->default('percent')
                            ->required(),
                        TextInput::make('value')
                            ->label('Value')
                            ->numeric()
                            ->required()
                            ->helperText('Percentage points, or rupees for a fixed discount.'),
                        TextInput::make('min_spend')
                            ->label('Minimum Spend')
                            ->numeric()
                            ->default(0),
                        TextInput::make('max_discount')
                            ->label('Maximum Discount')
                            ->numeric()
                            ->helperText('Caps the discount. Leave empty for no cap.'),
                    ]),
                Section::make('Usage')
                    ->columns(2)
                    ->components([
                        TextInput::make('max_uses')
                            ->label('Total Uses')
                            ->numeric()
                            ->helperText('Leave empty for unlimited.'),
                        TextInput::make('per_user_limit')
                            ->label('Per Customer Limit')
                            ->numeric()
                            ->helperText('Leave empty for no limit.'),
                        DateTimePicker::make('starts_at')
                            ->label('Starts At'),
                        DateTimePicker::make('ends_at')
                            ->label('Ends At'),
                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
