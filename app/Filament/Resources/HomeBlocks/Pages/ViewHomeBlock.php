<?php

namespace App\Filament\Resources\HomeBlocks\Pages;

use App\Filament\Resources\HomeBlocks\HomeBlockResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHomeBlock extends ViewRecord
{
    protected static string $resource = HomeBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
