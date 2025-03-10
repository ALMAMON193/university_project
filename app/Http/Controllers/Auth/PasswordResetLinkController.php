<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the status of the password reset link attempt
        if ($status == Password::RESET_LINK_SENT) {
            // If the reset link was sent successfully, redirect back with a success status message
            return back()->with('status', __('A password reset link has been sent to your email address.'));
        } else {
            // If there was an error, redirect back with the email input and an error message
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        }
    }
}
