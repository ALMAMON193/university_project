<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * This card model is belongs to the user table.
     * every card has a single user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
