<?php

namespace App\Filament\Resources\ContactRequests;

use App\Filament\Resources\ContactRequests\Pages\ListContactRequests;
use App\Filament\Resources\ContactRequests\Pages\ViewContactRequest;
use App\Filament\Resources\ContactRequests\Schemas\ContactRequestForm;
use App\Filament\Resources\ContactRequests\Schemas\ContactRequestInfolist;
use App\Filament\Resources\ContactRequests\Tables\ContactRequestsTable;
use App\Models\ContactRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ContactRequestResource extends Resource
{
    protected static ?string $model = ContactRequest::class;

    protected static string|UnitEnum|null $navigationGroup = null;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return 'Contact request';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Contact requests';
    }

    public static function getNavigationLabel(): string
    {
        return 'Contact requests';
    }

    public static function form(Schema $schema): Schema
    {
        return ContactRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactRequests::route('/'),
            'view' => ViewContactRequest::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
