<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'type',
        'title',
        'event_date',
        'start_time',
        'end_time',
        'location_name',
        'location_address',
        'google_maps_url',
        'is_main_event',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_main_event' => 'boolean',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
