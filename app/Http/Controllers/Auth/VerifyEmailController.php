<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    // In your VerifyEmailController
    // In app/Http/Controllers/Auth/VerifyEmailController.php

    public function __invoke(EmailVerificationRequest $request, User $user)
    {
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Add this line to log in the user after verification
        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1')
            ->with('t-success', 'Email verified successfully! You are now logged in.');
    }
}
