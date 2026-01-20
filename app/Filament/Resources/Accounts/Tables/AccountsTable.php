<?php

namespace App\Filament\Resources\Accounts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nama Akun')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->colors([
                        'primary' => 'asset',
                        'danger' => 'liability',
                        'success' => 'equity',
                        'warning' => 'revenue',
                        'info' => 'expense',
                        'gray' => 'cogs',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'asset' => 'Aset',
                        'liability' => 'Kewajiban',
                        'equity' => 'Modal',
                        'revenue' => 'Pendapatan',
                        'expense' => 'Biaya',
                        'cogs' => 'HPP',
                        default => ucfirst($state),
                    }),

                TextColumn::make('subtype')
                    ->label('Sub Tipe')
                    ->badge()
                    ->colors([
                        'primary' => 'current_asset',
                        'success' => 'fixed_asset',
                        'warning' => 'inventory',
                        'danger' => 'current_liability',
                        'info' => 'operating_expense',
                        'gray' => 'other_expense',
                    ])
                    ->formatStateUsing(fn ($state) => str_replace('_', ' ', ucfirst($state))
                    ),

                TextColumn::make('normal_balance')
                    ->label('Saldo Normal')
                    ->badge()
                    ->colors([
                        'success' => 'debit',
                        'danger' => 'credit',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('opening_balance')
                    ->label('Saldo Awal')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('parent_id')
                    ->label('Parent')
                    ->numeric()
                    ->sortable(),

                /* ===== BOOLEAN → BADGE ===== */
                TextColumn::make('is_active')
                    ->label('Aktif')
                    ->badge()
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Nonaktif'),

                TextColumn::make('is_cash_account')
                    ->label('Kas')
                    ->badge()
                    ->colors([
                        'success' => true,
                        'gray' => false,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Kas' : '-'),

                TextColumn::make('is_bank_account')
                    ->label('Bank')
                    ->badge()
                    ->colors([
                        'info' => true,
                        'gray' => false,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Bank' : '-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
