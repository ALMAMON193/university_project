<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;
    protected $guarded = [];

    // accessor of avater attribute
    public function getAvatarAttribute($value)
    {
        // Check if $value contains the substring 'google'
        if (strpos($value, 'https://') !== false) {
            return $value; // Return original $value if it contains 'google'
        } else {
            return $value ? asset('storage/' . $value) : null; // Otherwise, prepend 'storage/' and return
        }
    }

    /**
     * One to many relationship
     * user table with user_profile table
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * every user belongs to a state
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
