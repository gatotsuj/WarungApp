<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('city'),
                TextInput::make('province'),
                TextInput::make('postal_code'),
                Select::make('type')
                    ->options(['retail' => 'Retail', 'wholesale' => 'Wholesale', 'corporate' => 'Corporate'])
                    ->default('retail')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
