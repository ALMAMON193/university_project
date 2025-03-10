<?php

namespace App\Http\Controllers\backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\Cars_And_Bids;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutPageController extends Controller
{
    /**
     * return view & array
     */
    public function headerText()
    {
        $data = Cars_And_Bids::all();
        return view('backend.layout.CMS.car-and-bid.header', compact('data'));
    }

    /**
     * return view & array
     */
    public function aboutUs()
    {
        $data = Cars_And_Bids::all();
        return view('backend.layout.CMS.car-and-bid.about-us', compact('data'));
    }

        /**
     * return view & array
     */
    public function myWord()
    {
        $data = Cars_And_Bids::all();
        return view('backend.layout.CMS.car-and-bid.my-word', compact('data'));
    }

        /**
     * return view & array
     */
    public function features()
    {
        $data = Cars_And_Bids::all();
        return view('backend.layout.CMS.car-and-bid.features', compact('data'));
    }
        /**
     * return view & array
     */
    public function biddingCar()
    {
        $data = Cars_And_Bids::all();
        return view('backend.layout.CMS.car-and-bid.bid-car', compact('data'));
    }

        /**
     * return view & array
     */
    public function sellingCar()
    {
        $data = Cars_And_Bids::all();
        return view('backend.layout.CMS.car-and-bid.sell-car', compact('data'));
    }

        /**
     * return view & array
     */
    public function finalizeSell()
    {
        $data = Cars_And_Bids::all();
        return view('backend.layout.CMS.car-and-bid.finalize-sell', compact('data'));
    }

    /**
     * Update the about page contents but not title
     * taking input from a form
     * returns error or success tost
     */
    public function content(Request $request)
    {

        $data = Cars_And_Bids::find($request->id);
        // dd($request->all(), $data->image_url);
        $image_url = null;

        // Define the validation rules
        $rules = [
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048'
        ];
        // Create a validator instance with the request data and rules
        $validator = Validator::make($request->all(), $rules);
        // returning the validation error
        if ($validator->fails()) {

            return redirect()->back()->with('t-error', $validator->errors()->first());
        }

        try {
            if ($request->has('image_url')) {
                $image = $request->file('image_url');
                $image_url = uploadImage($image, 'images/cms');
                $data->update([
                    'description' => $request->description,
                    'image_url' => $image_url,
                ]);

            } else {
                $data->update([
                    'description' => $request->description,
                ]);
            }

            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    /**
     * Update the about page title, contents and image
     * taking input from a form
     * returns error or success tost
     */
    public function title_content_image(Request $request)
    {
        $data = Cars_And_Bids::find($request->id);
        $image_url = null;

        // Define the validation rules
        $rules = [
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048'
        ];
        // Create a validator instance with the request data and rules
        $validator = Validator::make($request->all(), $rules);
        // returning the validation error
        if ($validator->fails()) {

            return redirect()->back()->with('t-error', $validator->errors()->first());
        }

        try {
            if ($request->has('image_url')) {
                $image = $request->file('image_url');
                $image_url = uploadImage($image, 'images/cms');

                $data->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image_url' => $image_url,
                ]);
            } else {
                $data->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);
            }


            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    /**
     * Update the about page title & contents
     * taking input from a form
     * returns error or success tost
     */
    public function title_content(Request $request)
    {
        $data = Cars_And_Bids::find($request->id);
        try {
            $data->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    /**
     * Update the about page hero text
     * taking input from a form
     * returns error or success tost
     */
    public function create_hero_text(Request $request)
    {
        $data = Cars_And_Bids::find($request->id);
        try {
            $data->update([
                'description' => $request->description,
            ]);
            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    /**
     * deleteing the image from the how_it_works database
     */
    public function destroy_content_image(Request $request)
    {
        $how_it_works = Cars_And_Bids::find($request->id);
        try {
            $result = deleteImage($how_it_works->image_url);

            $how_it_works->image_url = null;

            $how_it_works->save();

            if ($result) {
                return redirect()->back()->with('t-success', 'Deleted Successfully');
            } else {
                return redirect()->back()->with('t-error', 'No Image to Delete');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

}
