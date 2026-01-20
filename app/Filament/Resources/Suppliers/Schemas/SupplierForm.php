<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('contact_person'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('city'),
                TextInput::make('tax_number'),
                Select::make('payment_term')
                    ->options([
            'cash' => 'Cash',
            'credit_7' => 'Credit 7',
            'credit_14' => 'Credit 14',
            'credit_30' => 'Credit 30',
            'credit_45' => 'Credit 45',
            'credit_60' => 'Credit 60',
        ])
                    ->default('cash')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
