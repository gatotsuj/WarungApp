<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Info Transaksi')
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Transaksi')
                            ->default(function () {
                                return 'TRX-'.date('Ymd').'-'.str_pad(
                                    Transaction::whereDate('created_at', today())->count() + 1,
                                    4, '0', STR_PAD_LEFT
                                );
                            })
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => '⏳ Pending',
                                'processing' => '🔄 Diproses',
                                'completed' => '✅ Selesai',
                                'cancelled' => '❌ Dibatalkan',
                            ])
                            ->default('pending')
                            ->required()
                            ->native(false),
                    ])->columns(2),

                Section::make('Info Customer')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Nama Customer')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('customer_phone')
                            ->label('No. HP')
                            ->tel()
                            ->maxLength(20),

                        Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Total')
                    ->schema([
                        TextInput::make('total_amount')
                            ->label('Total Transaksi')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->disabled()
                            ->dehydrated(),
                    ])->hiddenOn('create'),
            ]);

    }
}
