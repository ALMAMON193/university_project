<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\EmailVerificationOtpNotification;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Store the user before logging out
        $user = Auth::user();

        // Check if the email is verified
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();

            $otp = $user->generateNewOtp();
            // Send OTP email
            $user->notify(new EmailVerificationOtpNotification($otp));
            return redirect()->route('verification.otp')
            ->with('email', $user->email)
            ->with('t-success', 'Please verify your email before logging in.');
        }
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('t-success', 'Admin Login Successfully');
        }
        return redirect()->route('home-page')->with('t-success', 'Login Successfully');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/');
        return redirect()->route('home-page')->with('t-success', 'You are successfully logged out');
    }
}
