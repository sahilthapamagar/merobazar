<?php

namespace App\Filament\Resources\Sellers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                TextColumn::make('pan_number')
                    ->label('PAN No.')
                    ->copyable()
                    ->searchable(),
                ImageColumn::make('citizenship_photo')
                    ->label('Citizenship')
                    ->circular()
                    ->size(40),
                ImageColumn::make('image')
                    ->label('PAN Card')
                    ->circular()
                    ->size(40),
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
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('approve_seller')
                    ->label('Approve')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn (\App\Models\Seller $record): bool => $record->status !== 'active')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('password')
                            ->label('Seller Password')
                            ->placeholder('Enter password or leave blank to auto-generate')
                            ->helperText('If left blank, a secure 10-character password will be auto-generated and emailed with the Khalti Key and username.'),
                    ])
                    ->modalHeading('Approve Seller & Share Credentials')
                    ->modalDescription('Approve this seller and email their login username, password, and Khalti Secret Key.')
                    ->modalSubmitActionLabel('Approve & Send Email')
                    ->action(function (\App\Models\Seller $record, array $data) {
                        $password = !empty($data['password']) ? trim($data['password']) : \Illuminate\Support\Str::random(10);
                        $record->status = 'active';
                        if (! $record->expired_date) {
                            $record->expired_date = now()->addYear()->toDateString();
                        }
                        $record->password = \Illuminate\Support\Facades\Hash::make($password);
                        $record->saveQuietly();

                        try {
                            \Illuminate\Support\Facades\Mail::to($record->email)->send(new \App\Mail\SellerApprovalMail($record, $password, $record->khalti_secrect_key));
                            \Filament\Notifications\Notification::make()
                                ->title('Seller Approved & Credentials Sent')
                                ->body("Login details, Password ({$password}), and Khalti Key emailed to {$record->email}.")
                                ->success()
                                ->send();
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error("Mail error: " . $e->getMessage());
                            \Filament\Notifications\Notification::make()
                                ->title('Seller Approved (Mail Failed)')
                                ->body("Seller activated with password: {$password}. Mail error: " . $e->getMessage())
                                ->warning()
                                ->send();
                        }
                    }),
                \Filament\Actions\Action::make('resend_credentials')
                    ->label('Share Credentials')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->visible(fn (\App\Models\Seller $record): bool => $record->status === 'active')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('password')
                            ->label('Seller Password')
                            ->placeholder('Enter new password or leave blank to auto-generate')
                            ->helperText('If left blank, a new 10-character password will be auto-generated and emailed with the Khalti Key and username.'),
                    ])
                    ->modalHeading('Share Credentials with Seller')
                    ->modalDescription('This will email the seller their login username/email, password, and Khalti Secret Key.')
                    ->modalSubmitActionLabel('Send Email')
                    ->action(function (\App\Models\Seller $record, array $data) {
                        $password = !empty($data['password']) ? trim($data['password']) : \Illuminate\Support\Str::random(10);
                        $record->password = \Illuminate\Support\Facades\Hash::make($password);
                        $record->saveQuietly();

                        try {
                            \Illuminate\Support\Facades\Mail::to($record->email)->send(new \App\Mail\SellerApprovalMail($record, $password, $record->khalti_secrect_key));
                            \Filament\Notifications\Notification::make()
                                ->title('Credentials Shared')
                                ->body("Login details, Password ({$password}), and Khalti Key emailed to {$record->email}.")
                                ->success()
                                ->send();
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error("Mail error: " . $e->getMessage());
                            \Filament\Notifications\Notification::make()
                                ->title('Password Set (Mail Failed)')
                                ->body("Password set to: {$password}. Mail error: " . $e->getMessage())
                                ->warning()
                                ->send();
                        }
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
