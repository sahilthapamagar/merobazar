<?php

namespace App\Filament\Resources\Coupons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                TextColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(fn (string $state): string => $state === 'percent' ? 'Percentage' : 'Fixed')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'percent' ? 'info' : 'gray'),
                TextColumn::make('value')
                    ->label('Value')
                    ->money('Npr', true)
                    ->sortable(),
                TextColumn::make('min_spend')
                    ->label('Min Spend')
                    ->money('Npr', true)
                    ->sortable(),
                TextColumn::make('uses_count')
                    ->label('Used')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_uses')
                    ->label('Limit')
                    ->placeholder('∞')
                    ->sortable(),
                TextColumn::make('ends_at')
                    ->label('Ends')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'percent' => 'Percentage',
                        'fixed' => 'Fixed Amount',
                    ]),
                TernaryFilter::make('active')
                    ->label('Active'),
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
