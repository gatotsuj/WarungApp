<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Product;
use App\Models\Transaction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama Customer')
                                    ->required(),

                                TextInput::make('phone')
                                    ->label('No. HP'),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->email(),

                                TextInput::make('address')
                                    ->label('Alamat'),

                                TextInput::make('city')
                                    ->label('Kota'),

                                TextInput::make('province')
                                    ->label('Provinsi'),

                                TextInput::make('postal_code')
                                    ->label('Kode Pos'),

                                Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true),
                            ])
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

                                $set('customer_address', $alamat);
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

                        TextInput::make('customer_address')
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
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $product = Product::find($state);
                                        $set('price', $product?->price ?? 0);
                                        $set('quantity', 1);
                                        $set('subtotal', $product?->price ?? 0);

                                        // Update total amount
                                        self::updateTotalAmount($get, $set);
                                    }),

                                TextInput::make('quantity')
                                    ->label('Qty')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        $set('subtotal', $get('quantity') * $get('price'));

                                        // Update total amount
                                        self::updateTotalAmount($get, $set);
                                    }),

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
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                self::updateTotalAmount($get, $set);
                            })
                            ->deleteAction(
                                fn ($action) => $action->after(function (Get $get, Set $set) {
                                    self::updateTotalAmount($get, $set);
                                })
                            )
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => Product::find($state['product_id'])?->name ?? 'Produk baru'
                            ),
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

    /**
     * Update total amount dari semua items
     */
    protected static function updateTotalAmount(Get $get, Set $set): void
    {
        // Collect semua items dan hitung total
        $total = collect($get('../../items'))
            ->filter(fn ($item) => ! empty($item['subtotal']))
            ->sum('subtotal');

        $set('../../total_amount', $total);
    }
}
