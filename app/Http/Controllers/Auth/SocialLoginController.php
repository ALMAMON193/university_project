<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialLogin;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // return the socialLite driver
    public function toProvide($driver)
    {
        try {
            return Socialite::driver($driver)->redirect();

        } catch (Exception $e) {

        }
    }

    /**
     * Handle callback from social login provider.
     *
     * This function handles the callback from a social login provider,
     * authenticating users and creating necessary records if they do not exist.
     *
     * @param string $driver The driver/provider name (e.g., 'google', 'facebook').
     * @return \Illuminate\Http\RedirectResponse Redirects the user after processing.
     */
    public function handleCallBack($driver)
    {
        DB::beginTransaction();
        try {
            // Getting the user information
            $user = Socialite::driver($driver)->user();

            // Checking if the user is present in the social logins table
            $user_account = SocialLogin::where('provider', $driver)->where('provider_id', $user->id)->first();

            if ($user_account) {
                Auth::login($user_account->user);
                Session::regenerate();

                DB::commit(); // Commit transaction
                return redirect('/');
            }

            // Check if user exists based on email
            $db_user = User::where('email', $user->getEmail())->first();

            if ($db_user) {
                // If user exists, create a social login record
                SocialLogin::create([
                    'provider' => $driver,
                    'provider_id' => $user->getId(),
                    'user_id' => $db_user->id,
                ]);
            } else {
                // If user does not exist, create a new user record
                $db_user = User::create([
                    'full_name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => bcrypt(rand(1000, 9999)),
                ]);

                // Save avatar to user profile
                $db_user->profile()->create([
                    'avatar' => $user->getAvatar(),
                ]);

                // Create a card with null values
                $db_user->card()->create([]);
                // create one balance log
                $db_user->balance()->create([]);

                // Create social login record for the new user
                SocialLogin::create([
                    'provider' => $driver,
                    'provider_id' => $user->getId(),
                    'user_id' => $db_user->id,
                ]);

                // Login the new user
                Auth::login($db_user);
                Session::regenerate();
            }

            DB::commit(); // Commit transaction
            return redirect('/');

        } catch (Exception $e) {
            DB::rollback(); // Rollback transaction on error
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }
}
