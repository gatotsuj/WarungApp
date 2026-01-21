<?php

namespace App\Filament\Resources\JournalEntryLines\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JournalEntryLineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('journal_entry_id')
                    ->relationship('journalEntry', 'id')
                    ->required(),
                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->required(),
                TextInput::make('debit')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('credit')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
