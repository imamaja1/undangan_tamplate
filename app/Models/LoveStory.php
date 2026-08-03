<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoveStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'title',
        'date',
        'description',
        'photo_path',
        'sort_order',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
