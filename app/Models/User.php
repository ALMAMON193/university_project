<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     *  One to One Relations
     *  user with user_prifile table
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     *  One to One Relations
     *  user with card table
     */
    public function card(): HasOne
    {
        return $this->hasOne(Card::class);
    }

    /**
     *  One to many relationship
     *  user table with Auction table
     */
    public function auctions(): HasMany
    {
        return $this->hasMany(Auction::class);
    }

    /**
     * One user can have multiple bids
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * one user can have multiple wishes
     */
    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }


    /**
     * has one balance log
     */
    public function balance(): HasOne
    {
        return $this->hasOne(UserBalance::class);
    }

    /**
     * One user can have multiple transactions
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * user can have multiple accounts
     */
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class);
    }


    public function isAdmin()
    {
        return $this->role === 'admin'; // Assuming you have a 'role' field in your users table
    }

    public function isUser()
    {
        return $this->role === 'user'; // Assuming you have a 'role' field in your users table
    }

    // Custom method to check if there are users who have bids on ended auctions
    public function hasUsersBidsOnActivedAuctions()
    {
        return $this->bids()->whereHas('auction', function ($query) {
            $query->where('status', 'approve');
        });
    }
}
