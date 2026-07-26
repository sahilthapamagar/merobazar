<?php

namespace App\Filament\Seller\Resources\Sellers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SellerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('shop_name')
                    ->required(),
                TextInput::make('registration_number')
                    ->label('Registration Number')
                    ->required(),
                FileUpload::make('citizenship_photo')
                    ->label('Citizenship Photo')
                    ->image()
                    ->directory('seller-documents/citizenship')
                    ->visibility('public'),
                FileUpload::make('image')
                    ->label('PAN / Company Registration')
                    ->image()
                    ->directory('seller-documents/registration')
                    ->visibility('public'),
                TextInput::make('khalti_secrect_key'),
                Select::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive', 'pending' => 'Pending', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
                DatePicker::make('expired_date'),
                TextInput::make('contact')
                    ->required(),
            ]);
    }
}
