<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;
use Usamamuneerchaudhary\Commentify\Models\Comment;

class Auction extends Model
{
    use HasFactory;
    // commentify
    use Commentable;
    // soft delete
    use SoftDeletes;

    protected $guarded = [];

    /**
     * every auction have a user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * every auction can have multiple images
     */
    public function auctionImageGallery(): HasMany
    {
        return $this->hasMany(AuctionImageGallery::class);
    }

    /**
     * every auction can have multiple videos
     */
    public function auctionVideoGallery(): HasMany
    {
        return $this->hasMany(AuctionVideoGallery::class);
    }

    /**
     * every auction belongs to a state
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * one auction can have multiple bids
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    // return the max bid amount
    public function maxBid()
    {
        return $this->bids()->max('bid');
    }

    // getting all the comments of a perticular auction
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // one auction can appear in multiple wishes
    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    // is wished
    public function isWished()
    {
        return $this->wishlist()->where('user_id', auth()->user()->id)->exists();
    }

    // find all unique years
    public static function allYears()
    {
        return static::select('year')
            ->where(function ($query) {
                $query->where('status', 'approve')
                    ->orWhere('status', 'pending');
            })
            ->distinct()
            ->orderBy('year')
            ->get();
    }


    // find all unique model 
    public static function allModels()
    {
        return static::select('model')
            ->where(function ($query) {
                $query->where('status', 'approve')
                    ->orWhere('status', 'pending');
            })
            ->distinct()
            ->orderBy('model')
            ->get();
    }

    // find all unique make
    public static function allMakes()
    {
        return static::select('make')
            ->where(function ($query) {
                $query->where('status', 'approve')
                    ->orWhere('status', 'pending');
            })
            ->distinct()
            ->orderBy('make')
            ->get();
    }


    public function winner() {
        return $this->bids()->where('winn', true)->get();
    }
}
