<?php

namespace App\Filament\Resources\Accounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Select::make('type')
                    ->options([
            'asset' => 'Asset',
            'liability' => 'Liability',
            'equity' => 'Equity',
            'revenue' => 'Revenue',
            'cogs' => 'Cogs',
            'expense' => 'Expense',
        ])
                    ->required(),
                Select::make('subtype')
                    ->options([
            'current_asset' => 'Current asset',
            'fixed_asset' => 'Fixed asset',
            'inventory' => 'Inventory',
            'current_liability' => 'Current liability',
            'long_term_liability' => 'Long term liability',
            'capital' => 'Capital',
            'retained_earnings' => 'Retained earnings',
            'sales_revenue' => 'Sales revenue',
            'other_revenue' => 'Other revenue',
            'purchase' => 'Purchase',
            'freight_in' => 'Freight in',
            'operating_expense' => 'Operating expense',
            'other_expense' => 'Other expense',
        ]),
                TextInput::make('parent_id')
                    ->numeric(),
                TextInput::make('opening_balance')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('normal_balance')
                    ->options(['debit' => 'Debit', 'credit' => 'Credit'])
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_cash_account')
                    ->required(),
                Toggle::make('is_bank_account')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
