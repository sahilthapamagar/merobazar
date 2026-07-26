<?php

namespace App\Filament\Resources\Sellers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SellerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Group::make()
                    ->schema([
                        Section::make('Seller Information')
                            ->schema([
                                TextInput::make('name'),
                                TextInput::make('email')
                                    ->label('Email address')
                                    ->email()
                                    ->required(),
                                TextInput::make('shop_name')
                                    ->required(),
                                TextInput::make('contact')
                                    ->required(),
                                TextInput::make('registration_number')
                                    ->label('Registration Number')
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Section::make('Upload Documents')
                            ->icon(Heroicon::Photo)
                            ->schema([
                                FileUpload::make('citizenship_photo')
                                    ->label('Citizenship Photo')
                                    ->image(),
                                FileUpload::make('image')
                                    ->label('Profile Image')
                                    ->image(),
                            ]),
                    ])->columns(2),

                Section::make('Account Information')
                    ->icon(Heroicon::LockClosed)
                    ->schema([
                        TextInput::make('khalti_secrect_key'),
                        Section::make('Account Status')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                        'pending' => 'Pending',
                                        'rejected' => 'Rejected',
                                    ])
                                    ->required(),
                                TextInput::make('rejected_reason')
                                    ->label('Rejected Reason Only for (Reject Status)'),
                                DatePicker::make('expired_date')
                                    ->label('Expired Date'),
                            ])->columns(2),
                    ]),
            ])->columns(1);
    }
}
