<?php

namespace App\Filament\Resources\JournalEntryLines;

use App\Filament\Resources\JournalEntryLines\Pages\CreateJournalEntryLine;
use App\Filament\Resources\JournalEntryLines\Pages\EditJournalEntryLine;
use App\Filament\Resources\JournalEntryLines\Pages\ListJournalEntryLines;
use App\Filament\Resources\JournalEntryLines\Schemas\JournalEntryLineForm;
use App\Filament\Resources\JournalEntryLines\Tables\JournalEntryLinesTable;
use App\Models\JournalEntryLine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JournalEntryLineResource extends Resource
{
    protected static ?string $model = JournalEntryLine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'JournalEntryLine';

    public static function form(Schema $schema): Schema
    {
        return JournalEntryLineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JournalEntryLinesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJournalEntryLines::route('/'),
            'create' => CreateJournalEntryLine::route('/create'),
            'edit' => EditJournalEntryLine::route('/{record}/edit'),
        ];
    }
}
