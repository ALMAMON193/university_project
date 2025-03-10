<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\State;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * returns the view of profile edite page for user
     */
    public function index()
    {
        try {
            $user = auth()->user();
            $states = State::all();
            // $wishlists = $user->wishlist()->get();
            $data = [
                'user' => $user,
                'states' => $states,
            ];
            return view('frontend.layout.profile', compact('data'));
        } catch (Exception $e) {
            return redirect()->route('home-page')->with('t-error', 'Something went wrong');
        }

    }

    /**
     * Public info form update
     * argument form request
     * return blade with tost
     */
    public function UpdatePublicInfo(Request $request)
    {
        // dd($request->all());
        $input = $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'bio' => 'nullable',
        ]);

        try {
            $user = auth()->user();
            $profile = $user->profile;

            $user->update([
                'full_name' => $input['full_name'],
            ]);

            $profile->update([
                'phone' => $input['phone'],
                'address' => $input['address'],
                'bio' => $input['bio'],
            ]);
            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');

        }
    }


    /**
     * Update the user profile values
     * arguments form Required
     * return blade with tost.
     */
    public function UpdatePrivateInfo(Request $request)
    {
        // dd($request->all());
        $input = $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ], [
            'password.regex' => 'The password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).',
        ]);

        try {

            $user = auth()->user();
            $profile = $user->profile;
            $user->update([
                'email' => $input['email'],
                'password' => $input['password'] ? bcrypt($input['password']) : $user->password,
            ]);

            $profile->update([
                'city' => $input['city'],
                'state_id' => $input['state'],
                'zip' => $input['zip']
            ]);
            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    /**
     * update card of the users
     * arguments form Required
     * return blade with tost.
     */
    public function updateCard(Request $request)
    {


        dd($request->all());
        $input = $request->validate([
            'card_name' => 'required',
            'card_number' => 'required|max:19|min:19',
            'expiry_date' => 'required',
            'cvc' => 'required|max:4|min:3'
        ], [
            'card_number' => 'Enter your card number',
        ]);

        try {
            $card = auth()->user()->card;
            $card->update($input);
            return redirect()->back()->with('t-success', 'Updated Successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    /**
     * Update the user photo on profile table
     * Argument form request
     * return blade wiht tost.
     */
    public function updateImage(Request $request)
    {
        try {
            $request->validate([
                'avater' => 'image|mimes:jpeg,png,jpg,svg|max:1024',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
                'status' => 400
            ], 400);
        }

        try {
            if ($request->ajax()) {
                $avatar = $request->file('avatar');
                if ($avatar) {
                    // finding the profile of the user
                    $profile = auth()->user()->profile;
                    // if there is an image of an user delete it
                    if ($profile->avatar) {
                        deleteImage($profile->avatar);
                    }
                    // saving the image of the user on the storage
                    $avatar = uploadImage($avatar, 'images/avatars');
                    // uploading the path on the database
                    $profile->update([
                        'avatar' => $avatar,
                    ]);
                    // returning the response
                    return response()->json([
                        'success' => true,
                        'message' => "Image Uploaded Successfully",
                        'status' => 200
                    ], 200);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Something went wrong",
                'status' => 400
            ], 400);
        }
    }


    /**
     * Delete the user
     */
    public function destory()
    {
        try {
            $user = auth()->user();
            // Logout
            Auth::logout();
            // delete user
            $user->delete();
            // redirect to the home page
            return redirect()->route('home-page')->with('t-success', 'Your Account is Deleted');
        } catch (Exception $e) {
            return redirect()->route('home-page')->with('t-error', 'Something went wrong. Please try again later.');
        }
    }

}
