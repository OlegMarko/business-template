<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company',
        'subject',
        'message',
        'reviewed',
    ];

    protected $casts = [
        'reviewed' => 'boolean',
    ];

    public function getSubjectLabelAttribute(): string
    {
        return match ($this->subject) {
            'general' => 'General enquiry',
            'services' => 'Services',
            'partnership' => 'Partnership',
            'other' => 'Other',
            default => $this->subject,
        };
    }
}
