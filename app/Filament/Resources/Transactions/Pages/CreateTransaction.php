<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function afterSave(): void
    {
        $transaction = $this->record;

        $transaction->updateQuietly([
            'total_amount' => $transaction->items()->sum('subtotal'),
        ]);
    }
}
