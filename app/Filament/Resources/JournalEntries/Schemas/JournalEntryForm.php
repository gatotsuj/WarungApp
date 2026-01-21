<?php

namespace App\Filament\Resources\JournalEntries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JournalEntryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode')
                    ->required(),
                DatePicker::make('entry_date')
                    ->label('Tanggal Entri')
                    ->required(),
                Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'general' => 'Umum',
                        'sales' => 'Penjualan',
                        'purchase' => 'Pembelian',
                        'cash_receipt' => 'Penerimaan Kas',
                        'cash_payment' => 'Pengeluaran Kas',
                        'adjustment' => 'Penyesuaian',
                        'closing' => 'Penutupan',
                    ])
                    ->default('general')
                    ->required(),
                TextInput::make('reference_type')
                    ->label('Tipe Referensi'),
                TextInput::make('reference_id')
                    ->label('ID Referensi')
                    ->numeric(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('total_debit')
                    ->label('Total Debit')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_credit')
                    ->label('Total Kredit')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('status')
                    ->label('Status')
                    ->options(['draft' => 'Draft', 'posted' => 'Diposting', 'void' => 'Batal'])
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('posted_at')
                    ->label('Diposting Pada'),
                TextInput::make('posted_by')
                    ->label('Diposting Oleh')
                    ->numeric(),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }
}
