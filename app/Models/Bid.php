<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /**
     * every bid must have a user
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * every bid must have na auciton
     */
    public function auction(): BelongsTo {
        return $this->belongsTo(Auction::class);
    }

}
