<?php

namespace App\Filament\Seller\Resources\FlashSales\Tables;

use App\Models\FlashSale;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FlashSalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('product.main_image')
                    ->label('Product Image'),
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product.price')
                    ->label('Normal Price')
                    ->money('Npr', true)
                    ->sortable(),
                TextColumn::make('flash_price')
                    ->label('⚡ Flash Price')
                    ->money('Npr', true)
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('discount_percent')
                    ->label('Discount')
                    ->suffix('% OFF')
                    ->badge()
                    ->color('success'),
                TextColumn::make('sold_quantity')
                    ->label('Sold / Stock')
                    ->formatStateUsing(fn (FlashSale $record) => "{$record->sold_quantity} / {$record->flash_stock}")
                    ->badge()
                    ->color(fn (FlashSale $record) => $record->is_sold_out ? 'danger' : 'info'),
                TextColumn::make('start_time')
                    ->label('Starts')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                TextColumn::make('end_time')
                    ->label('Ends')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                TextColumn::make('current_status_label')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string|array => match ($state) {
                        'Active' => 'success',
                        'Scheduled' => 'info',
                        'Ended' => 'gray',
                        'Sold Out' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->label('Cancel / Delete'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
