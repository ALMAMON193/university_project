<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auction() : BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }
}
