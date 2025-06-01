<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\EmailVerificationOtpNotification;

class User extends Authenticatable implements MustVerifyEmail
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
        'email_verification_otp',
        'email_verification_otp_expires_at',
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
    public function sendEmailVerificationOtpNotification()
    {
        $this->notify(new EmailVerificationOtpNotification($this->email_verification_otp));
    }
        /**
     * Generate and save a new OTP
     */
    public function generateNewOtp(): string
    {
        $otp = rand(100000, 999999); // 6-digit OTP
        $this->update([
            'email_verification_otp' => $otp,
            'email_verification_otp_expires_at' => now()->addMinutes(10)
        ]);
        return $otp;
    }

    /**
     * Check if OTP is valid
     */
    public function isValidOtp(string $otp): bool
    {
        return $this->email_verification_otp === $otp &&
               $this->email_verification_otp_expires_at > now();
    }

    /**
     * Mark email as verified
     */
    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => now(),
            'email_verification_otp' => null,
            'email_verification_otp_expires_at' => null
        ])->save();
    }

    /**
     * Determine if the user has verified their email address.
     */
    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }
}
