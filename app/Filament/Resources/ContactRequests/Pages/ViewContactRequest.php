<?php

namespace App\Filament\Resources\ContactRequests\Pages;

use App\Filament\Resources\ContactRequests\ContactRequestResource;
use App\Models\ContactRequest;
use Filament\Resources\Pages\ViewRecord;

class ViewContactRequest extends ViewRecord
{
    protected static string $resource = ContactRequestResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        /** @var ContactRequest $contactRequest */
        $contactRequest = $this->getRecord();
        if (! $contactRequest->reviewed) {
            $contactRequest->update(['reviewed' => true]);
        }
    }
}
