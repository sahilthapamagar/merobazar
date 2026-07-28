<?php

namespace App\Filament\Seller\Resources\Sellers\Schemas;

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
                                    ->image()
                                    ->directory('seller-documents/citizenship')
                                    ->visibility('public'),
                                FileUpload::make('image')
                                    ->label('Profile Image')
                                    ->image()
                                    ->directory('seller-documents/registration')
                                    ->visibility('public'),
                            ]),
                    ])->columns(2),

                Section::make('Account Information')
                    ->icon(Heroicon::LockClosed)
                    ->schema([
                        TextInput::make('khalti_secrect_key'),
                        
                    ]),
            ])->columns(1);
    }
}
