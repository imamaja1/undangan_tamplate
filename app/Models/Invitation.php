<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'cover_image',
        'opening_message',
        'music_url',
        'theme',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brideGrooms(): HasMany
    {
        return $this->hasMany(BrideGroom::class);
    }

    public function loveStories(): HasMany
    {
        return $this->hasMany(LoveStory::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    public function rsvps(): HasMany
    {
        return $this->hasMany(Rsvp::class);
    }

    public function guestLists(): HasMany
    {
        return $this->hasMany(GuestList::class);
    }

    public function waConfig(): HasOne
    {
        return $this->hasOne(WaConfig::class);
    }
}
