<?php

namespace App\Filament\Resources\ContactRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact details')
                    ->components([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('company')
                            ->placeholder('—'),
                        TextEntry::make('subject')
                            ->formatStateUsing(fn ($record) => $record->subject_label)
                            ->badge(),
                        TextEntry::make('created_at')
                            ->label('Received at')
                            ->dateTime(),
                        IconEntry::make('reviewed')
                            ->label('Reviewed')
                            ->boolean(),
                    ])
                    ->columns(2),
                Section::make('Message')
                    ->components([
                        TextEntry::make('message')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
