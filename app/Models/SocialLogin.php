<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialLogin extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     *  SocialLogin belongs to a user
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
