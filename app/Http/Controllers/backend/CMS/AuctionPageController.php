<?php

namespace App\Http\Controllers\backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS_Content;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class AuctionPageController extends Controller
{
    /**
     * return the view
    */
    public function index() {
        $data = CMS_Content::all();
        return view('backend.layout.CMS.auction-page', compact('data'));
    }

    /**
     * Update the about page title, sub_title and image
     * taking input from a form
     * returns error or success toast
     */
    public function title_content_image(Request $request)
    {
        $data = CMS_Content::findOrFail($request->id);
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
                    'sub_title' => $request->sub_title,
                    'image_url' => $image_url,
                ]);
            } else {
                $data->update([
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                ]);
            }
            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    /**
     * deleteing the image from the image database
     */
    public function destroy_content_image(Request $request)
    {
        $image = CMS_Content::find($request->id);
        try {
            $result = deleteImage($image->image_url);

            $image->image_url = null;

            $image->save();

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
