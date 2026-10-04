<?php

namespace App\Filament\Seller\Resources\Orders\Tables;

use App\Mail\OrderStatusUpdatedMail;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Order #')
                    ->sortable()
                    ->prefix('#'),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Order Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'primary' => 'shipped',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ]),

                TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->money('NPR')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Payment')
                    ->badge()
                    ->colors([
                        'success' => 'khalti',
                        'gray' => 'cod',
                    ]),

                TextColumn::make('payment_status')
                    ->label('Pay Status')
                    ->badge()
                    ->colors([
                        'success' => fn ($state): bool => strtolower((string) $state) === 'completed',
                        'warning' => fn ($state): bool => strtolower((string) $state) === 'pending',
                        'danger' => fn ($state): bool => strtolower((string) $state) === 'failed',
                    ]),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('M d, Y · h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('notify_customer')
                    ->label('Notify Buyer')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('info')
                    ->modalHeading('Send Status Email to Customer')
                    ->modalDescription('Update order status and notify the buyer via email.')
                    ->modalSubmitActionLabel('Send Email & Update')
                    ->form([
                        TextInput::make('customer_email')
                            ->label('Customer Email')
                            ->default(fn (Order $record) => $record->user?->email)
                            ->disabled(),
                        Select::make('status')
                            ->label('Order Status')
                            ->options([
                                'pending' => 'Pending (Order Placed)',
                                'processing' => 'Processing (Order is being processed & On the way)',
                                'shipped' => 'Shipped (Order is on its way to the customer)',
                                'delivered' => 'Delivered (Order has been delivered)',
                                'cancelled' => 'Cancelled (Order has been cancelled)',
                            ])
                            ->default(fn (Order $record) => $record->status ?? 'pending')
                            ->required(),
                        Textarea::make('custom_note')
                            ->label('Optional Message / Note for Buyer')
                            ->placeholder('e.g. Your order is on the way with courier delivery.')
                            ->rows(3),
                    ])
                    ->action(function (Order $record, array $data) {
                        $record->status = $data['status'];
                        $record->save();

                        if ($record->user && ! empty($record->user->email)) {
                            try {
                                Mail::to($record->user->email)->send(new OrderStatusUpdatedMail($record, $data['custom_note'] ?? null));

                                Notification::make()
                                    ->title('Customer Notified')
                                    ->body("Order #{$record->id} updated to '{$record->status}' and emailed to {$record->user->email}.")
                                    ->success()
                                    ->send();
                            } catch (\Throwable $e) {
                                Log::error('Notify customer mail error: '.$e->getMessage());

                                Notification::make()
                                    ->title('Status Updated (Email Failed)')
                                    ->body('Order updated, but email sending failed: '.$e->getMessage())
                                    ->warning()
                                    ->send();
                            }
                        }
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
