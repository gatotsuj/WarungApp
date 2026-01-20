<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Product;
use App\Models\Transaction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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
                        Select::make('customer_id')
                            ->label('Customer')
                            ->relationship(
                                'customer',
                                'name',
                                fn ($query) => $query->where('is_active', true)
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $customer = \App\Models\Customer::find($state);

                                if (! $customer) {
                                    return;
                                }

                                $set('customer_name', $customer->name);
                                $set('customer_phone', $customer->phone);
                                $set('customer_email', $customer->email);

                                $alamat = collect([
                                    $customer->address,
                                    $customer->city,
                                    $customer->province,
                                    $customer->postal_code,
                                ])->filter()->implode(', ');

                                $set('customer_alamat', $alamat);
                            }),

                        TextInput::make('customer_name')
                            ->label('Nama Customer')
                            ->readOnly()
                            ->dehydrated(),

                        TextInput::make('customer_phone')
                            ->label('No. HP')
                            ->readOnly()
                            ->dehydrated(),

                        TextInput::make('customer_email')
                            ->label('Email')
                            ->readOnly()
                            ->dehydrated(),

                        TextInput::make('customer_alamat')
                            ->label('Alamat')
                            ->readOnly()
                            ->columnSpanFull()
                            ->dehydrated(),

                        Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Produk')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Produk')
                                    ->options(Product::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        $product = Product::find($state);
                                        $set('price', $product?->price ?? 0);
                                        $set('quantity', 1);
                                        $set('subtotal', $product?->price ?? 0);
                                    }),

                                TextInput::make('quantity')
                                    ->label('Qty')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn (Get $get, Set $set) => $set('subtotal', $get('quantity') * $get('price'))
                                    ),

                                TextInput::make('price')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),

                                TextInput::make('subtotal')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),
                            ])
                            ->columns(4)
                            ->reactive()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $total = collect($get('items'))
                                    ->sum(fn ($item) => $item['subtotal'] ?? 0);

                                $set('total_amount', $total);
                            }),
                    ])->columnSpanFull(),

                Section::make('Total')
                    ->schema([
                        TextInput::make('total_amount')
                            ->label('Total Transaksi')
                            ->prefix('Rp')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columnSpanFull(),

            ]);

    }
}
