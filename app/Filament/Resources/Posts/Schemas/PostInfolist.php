<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('published_at')
                            ->label('Published at')
                            ->dateTime()
                            ->placeholder('Draft'),
                        TextEntry::make('content')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
