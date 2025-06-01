<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Notifications\EmailVerificationOtpNotification;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'terms' => 'accepted',
        ], [
            'password.regex' => 'The password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create a profile with null values
        $user->profile()->create([]);
        // Create a card with null values
        $user->card()->create([]);
        // create one balance log
        $user->balance()->create([]);
        $otp = $user->generateNewOtp();
        // Send OTP email (you'll need to create this notification)
        $user->notify(new EmailVerificationOtpNotification($otp));

        return redirect()->route('verification.otp')
            ->with('email', $user->email)
            ->with('t-success', 'Registration successful. Please check your email for the OTP.');
    }
    public function showOtpForm(): View|RedirectResponse
    {

        return view('auth.verify-otp', [
            'email' => session('email'),
            'success' => session('t-success')
        ]);
    }

    public function verifyOtp(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'otp' => 'required|string|digits:6',
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)
            ->where('email_verification_otp', $request->otp)
            ->where('email_verification_otp_expires_at', '>', now())
            ->first();

        if (!$user || !is_string($user->email_verification_otp)) {
            return back()->with('error', 'Invalid or expired OTP')->withInput();
        }

        $user->markEmailAsVerified();

        Auth::login($user);

        return redirect()->route('home-page')->with('success', 'Verified successfully!');
    }

    /**
     * Resend the OTP.
     */
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = $user->generateNewOtp();
        $user->notify(new EmailVerificationOtpNotification($otp));

        return redirect()->route('verification.otp')
            ->with('t-success', 'A new OTP has been sent to your email.')
            ->with('email', $request->email);
    }
}
