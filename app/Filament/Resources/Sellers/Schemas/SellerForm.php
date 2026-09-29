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
                                TextInput::make('pan_number')
                                    ->label('PAN Number')
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Section::make('Upload Documents')
                            ->icon(Heroicon::Photo)
                            ->schema([
                                FileUpload::make('citizenship_photo')
                                    ->label('Citizenship Photo')
                                    ->image(),
                                FileUpload::make('image')
                                    ->label('PAN Card Photo')
                                    ->image(),
                            ]),
                        Section::make('PAN Verification')
                            ->description('Directly check if this PAN number is registered on Nepal IRD portal.')
                            ->schema([
                                \Filament\Forms\Components\Placeholder::make('ird_verification')
                                    ->hiddenLabel()
                                    ->content(function ($record) {
                                        $pan = $record?->pan_number ?? '';
                                        return new \Illuminate\Support\HtmlString('
                                            <div style="display:flex; flex-direction:column; gap:10px;">
                                                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:14px 18px;">
                                                    <div>
                                                        <div style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.06em; color:#6b7280; font-weight:600;">Seller PAN Number</div>
                                                        <div style="font-size:1.25rem; font-weight:700; color:#111827; font-family:monospace; margin-top:2px;">' . ($pan ? htmlspecialchars($pan) : '<span style="color:#9ca3af; font-weight:normal; font-size:0.9rem;">No PAN Number Provided</span>') . '</div>
                                                    </div>
                                                    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                                        ' . ($pan ? '
                                                        <button type="button"
                                                                onclick="navigator.clipboard.writeText(\'' . addslashes($pan) . '\'); alert(\'PAN ' . addslashes($pan) . ' copied to clipboard!\');"
                                                                style="display:inline-flex; align-items:center; gap:6px; background:#ffffff; color:#374151; border:1px solid #d1d5db; font-weight:600; font-size:0.82rem; padding:8px 14px; border-radius:6px; cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,0.05);">
                                                            <svg style="width:15px; height:15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                            📋 Copy PAN
                                                        </button>
                                                        ' : '') . '
                                                        <a href="https://ird.gov.np/pan-search/"
                                                           target="_blank"
                                                           rel="noopener noreferrer"
                                                           style="display:inline-flex; align-items:center; gap:8px; background:#16a34a; color:#ffffff; font-weight:600; font-size:0.82rem; padding:8px 16px; border-radius:6px; text-decoration:none; box-shadow:0 1px 2px rgba(0,0,0,0.05);">
                                                            <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                                            🔍 Verify on ird.gov.np/pan-search
                                                        </a>
                                                    </div>
                                                </div>
                                                <div style="font-size:0.78rem; color:#4b5563; line-height:1.4;">
                                                    <strong>Quick Verification:</strong> Click <strong>📋 Copy PAN</strong>, then click <strong>🔍 Verify on ird.gov.np/pan-search</strong>, paste the PAN to see if it exists in Nepal IRD, and then set the <strong>Account Status</strong> below to <code>Active</code> (Accept) or <code>Rejected</code> (Reject).
                                                </div>
                                            </div>
                                        ');
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Account Information')
                    ->icon(Heroicon::LockClosed)
                    ->schema([
                        TextInput::make('khalti_secrect_key')
                            ->label('Khalti Secret Key')
                            ->placeholder('Enter Khalti live secret key'),
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
