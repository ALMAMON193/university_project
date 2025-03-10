<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * one single state can multiple users
     * one to many relationship with State to UserProfile model.
     */
    public function userProfile(): HasMany
    {
        return $this->hasMany(UserProfile::class);
    }

    /**
     * every auction has a state
     */
    public function auction(): HasMany
    {
        return $this->hasMany(Auction::class);
    }
}
