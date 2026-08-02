<?php

namespace App\Filament\Resources\Sellers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SellersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->copyable()
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('shop_name')
                    ->label('Shop Name')
                    ->searchable(),
                TextColumn::make('registration_number')
                    ->label('Reg. No.')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('citizenship_photo')
                    ->label('Citizenship')
                    ->circular()
                    ->size(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image')
                    ->label('PAN / Company')
                    ->circular()
                    ->size(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('expired_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('contact')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
            ->filters([
            
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
