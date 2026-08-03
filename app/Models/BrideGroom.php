<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrideGroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'type',
        'full_name',
        'nickname',
        'father_name',
        'mother_name',
        'instagram_url',
        'photo_path',
        'description',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
