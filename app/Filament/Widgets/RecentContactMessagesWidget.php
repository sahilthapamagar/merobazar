<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentContactMessagesWidget extends TableWidget
{
    protected static ?int $sort = 4;

    protected static bool $isLazy = true;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactMessage::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('From')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->limit(25),
                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('message')
                    ->label('Message')
                    ->limit(45),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn (ContactMessage $record) => ContactMessageResource::getUrl('edit', ['record' => $record])),
            ])
            ->toolbarActions([]);
    }
}
