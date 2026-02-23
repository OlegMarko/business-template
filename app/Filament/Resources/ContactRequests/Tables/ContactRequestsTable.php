<?php

namespace App\Filament\Resources\ContactRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ContactRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('reviewed')
                    ->label('Reviewed')
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('company')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('subject')
                    ->formatStateUsing(fn ($record) => $record->subject_label)
                    ->badge()
                    ->sortable(),
                TextColumn::make('message')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
