<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuctionImageGallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    // accessor of url attribute
    public function getUrlAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    /**
     * every row own by an auction
     */
    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }
}
