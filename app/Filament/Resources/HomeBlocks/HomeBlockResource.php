<?php

namespace App\Filament\Resources\HomeBlocks;

use App\Filament\Resources\HomeBlocks\Pages\CreateHomeBlock;
use App\Filament\Resources\HomeBlocks\Pages\EditHomeBlock;
use App\Filament\Resources\HomeBlocks\Pages\ListHomeBlocks;
use App\Filament\Resources\HomeBlocks\Pages\ViewHomeBlock;
use App\Filament\Resources\HomeBlocks\Schemas\HomeBlockForm;
use App\Filament\Resources\HomeBlocks\Schemas\HomeBlockInfolist;
use App\Filament\Resources\HomeBlocks\Tables\HomeBlocksTable;
use App\Models\HomeBlock;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeBlockResource extends Resource
{
    protected static ?string $model = HomeBlock::class;

    protected static string|UnitEnum|null $navigationGroup = 'Site content';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HomeBlockForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HomeBlockInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeBlocksTable::configure($table);
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
            'index' => ListHomeBlocks::route('/'),
            'create' => CreateHomeBlock::route('/create'),
            'view' => ViewHomeBlock::route('/{record}'),
            'edit' => EditHomeBlock::route('/{record}/edit'),
        ];
    }
}
