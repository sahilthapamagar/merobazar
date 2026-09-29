<?php

namespace App\Filament\Seller\Resources\Products\Tables;

use App\Models\FlashSale;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('price')
                    ->money('Npr', true)
                    ->sortable(),
                TextColumn::make('discounted_price')
                    ->label('Discount Price')
                    ->money('Npr', true)
                    ->sortable(),
                TextColumn::make('flash_sale_status')
                    ->label('⚡ Flash Sale')
                    ->badge()
                    ->state(function (Product $record) {
                        $latest = $record->flashSales()->latest()->first();

                        return $latest ? $latest->current_status_label : 'None';
                    })
                    ->color(fn (string $state): string|array => match ($state) {
                        'Active' => 'success',
                        'Pending Approval' => 'warning',
                        'Scheduled' => 'info',
                        'Rejected' => 'danger',
                        'Ended' => 'gray',
                        'Sold Out' => 'danger',
                        default => 'gray',
                    }),
                ImageColumn::make('main_image'),

                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('add_to_flash_sale')
                    ->label('⚡ Add to Flash Sale')
                    ->icon(Heroicon::Bolt)
                    ->color(Color::Amber)
                    ->modalHeading(fn (Product $record) => 'Add "'.$record->name.'" to Flash Sale')
                    ->modalDescription('Set your discounted flash sale price, available quantity, and start/end time. It will display directly on the website homepage as a Flash Sale product.')
                    ->modalSubmitActionLabel('Launch Flash Sale')
                    ->form([
                        TextInput::make('flash_price')
                            ->label('Flash Sale Price (Rs.)')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->rules([
                                fn (Product $record) => function (string $attribute, $value, \Closure $fail) use ($record) {
                                    if ((float) $value <= 0) {
                                        $fail('Flash price must be greater than Rs. 0.');
                                    } elseif ((float) $value >= (float) $record->price) {
                                        $fail('Flash price must be strictly less than the normal price (Rs. '.number_format($record->price, 2).').');
                                    }
                                },
                            ])
                            ->helperText(fn (Product $record) => 'Original price is Rs. '.number_format($record->price, 2)),
                        TextInput::make('flash_stock')
                            ->label('Flash Sale Stock (Units)')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->default(10)
                            ->helperText('Maximum quantity customers can purchase at this flash price.'),
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
                            ->helperText('Flash sale automatically ends at this time, returning product to normal price.'),
                    ])
                    ->action(function (Product $record, array $data): void {
                        FlashSale::create([
                            'product_id' => $record->id,
                            'seller_id' => Auth::guard('vendor')->id() ?? $record->seller_id,
                            'flash_price' => $data['flash_price'],
                            'flash_stock' => $data['flash_stock'],
                            'sold_quantity' => 0,
                            'start_time' => $data['start_time'],
                            'end_time' => $data['end_time'],
                        ]);

                        Notification::make()
                            ->title('⚡ Flash Sale Launched!')
                            ->body('"'.$record->name.'" is now live on the homepage Flash Sale section at Rs. '.number_format($data['flash_price'], 2).'.')
                            ->success()
                            ->send();
                    }),
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
